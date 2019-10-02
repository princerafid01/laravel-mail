<?php

namespace App\Http\Controllers\Api;
use App\Attachment;
use App\BlacklistMail;
use App\Http\Controllers\Controller;
use App\Mail;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail as RealMail;


class MailController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('jwt.auth');
    }
    public function index()
    {
    	 
// 
        $mails = Mail::all();
        $all_m = [];
        foreach ($mails as $mail) {
        $all_m[] = [
            'id' => $mail->id,
                'sender' => $mail->sender,
                'sender_name' => $mail->sender_name,
                'to' => $mail->to,
                'img' => 'avatar-s-1.png',
                'subject' =>  $mail->subject,
                'cc' => $mail->cc ?? '',
                'bcc' => $mail->bcc ?? '',
                'message' => $mail->message,
                'attachments' => [],
                'isStarred' => $mail->isStarred,
                // Mon Dec 10 2018 07:46:00 GMT+0000 (GMT)
                'time' => date('D M d Y H:m:s O',strtotime($mail->time)),
                'replies' => [],
                'mailType' => $mail->mailType,
                'unread' => $mail->unread,
            ];
        }
        return response()->json($all_m);

    }

    public function test()
    {
        $oClient = \Webklex\IMAP\Facades\Client::account('default');
        //Connect to the IMAP Server
        $oClient->connect();
        //Get all Mailboxes
        /** @var \Webklex\IMAP\Support\FolderCollection $aFolder */
        $aFolder = $oClient->getFolders();
                    $a=[];
                    $b=[];
                    $mail = [];
                    



        //Loop through every Mailbox
        /** @var \Webklex\IMAP\Folder $oFolder */
        foreach($aFolder as $oFolder){

            //Get all Messages of the current Mailbox $oFolder
            /** @var \Webklex\IMAP\Support\MessageCollection $aMessage */
            echo '<pre>';
                var_dump($oFolder->name);
            echo '</pre>';
            $aMessage = $oFolder->messages()->all()->get();

            
            /** @var \Webklex\IMAP\Message $oMessage */
            foreach($aMessage as $oMessage){
                // var_dump($oMessage);
                // $a =[];  
                foreach ($oMessage->getAttachments() as $oAttachment) {
                    $a[]=$oAttachment->getName();
                    // readfile($file_url)
                }
                $mail[] =[
                    'id' => $oMessage->getMessageNo(),
            'sender' => $oMessage->getFrom()[0]->mail,
            'sender_name' => $oMessage->getFrom()[0]->personal,
            'to' => [$oMessage->getTo()[0]->mail],
            'img' => 'avatar-s-1.png',
            'subject' =>  $oMessage->getSubject(),
            'cc' => [$oMessage->getCc()[0] ?? ''],
            'bcc' => [$oMessage->getCc()[0] ?? ''],
            'message' => $oMessage->getBodies()['text']->content,
            'attachments' => $a,
            'isStarred' => false,
            'labels' => ['private'],
            // Mon Dec 10 2018 07:46:00 GMT+0000 (GMT)
            'time' => date('D M d Y H:m:s O',strtotime($oMessage->getDate())),
            'replies' => [],
            'mailType' => 'inboxed',
            'unread' => false,
            'content' => $b
                ];
                // echo '<pre>';
                
                // dd($oMessage->getDate());
                
                // echo '</pre>';
                // echo $oMessage->getSubject().'<br />';
                // echo 'Attachments: '.$oMessage->getAttachments()->count().'<br />';
                // echo $oMessage->getHTMLBody(true);
                
                //Move the current Message to 'INBOX.read'
                // if($oMessage->moveToFolder('INBOX.read') == true){
                //     echo 'Message has ben moved';
                // }else{
                //     echo 'Message could not be moved';
                // }
            }
        }
    }


    // Update Mail Reading 
    public function updateMailRead($id)
    {
        $mail = Mail::find($id)->update([
            'unread' => 0
        ]);
        if ($mail) {
            return response()->json(['data' =>200]);
        }
    }
    // Compose Mail
    public function sendMail(Request $request)
    {
        if ($request->mailCc) {
            $sent_mail = RealMail::to($request->mailTo)
                                ->cc($request->mailCc)
                                ->send(new SendMail($request));
        }elseif ($request->mailBCC) {
            $sent_mail = RealMail::to($request->mailTo)
                                ->bcc($request->mailBCC)
                                ->send(new SendMail($request));
        } elseif ($request->mailCc && $request->mailBCC) {
            $sent_mail = RealMail::to($request->mailTo)
                                ->cc($request->mailCc)
                                ->bcc($request->mailBCC)
                                ->send(new SendMail($request));
        } else{
            $sent_mail = RealMail::to($request->mailTo)
                                ->send(new SendMail($request));
        }

        
        $mail = Mail::create(
        [
                'sender' => Auth::user()->email,
                'sender_name' => Auth::user()->name,
                'to' => $request->mailTo,
                'img' => 'avatar-s-1.png',
                'subject' =>  $request->mailSubject,
                'cc' => $request->mailCc ?? '',
                'bcc' => $request->mailBCC ?? '',
                'message' => $request->mailMessage,
                'isStarred' => false,
                'time' => date('D M d Y H:m:s O'),
                'mailType' => 'sent',
                'unread' => false,
            ]); 
        if($request->file){
            foreach ($request->file as $vala) {
                $attachment = Attachment::create([
                    'mail_id' => $mail->id,
                    'attachment_name' => $vala->getClientOriginalName(),
                    'storage_name' => $vala->hashName()
                ]);
                $vala->store('public');
            }
        }
        return response()->json(['status' => 200]);
    }

    public function mailStar(Request $request)
    {
        $mail = Mail::find($request->mailId)->update([
            'isStarred' => $request->value
        ]);
        if ($mail) {
            return response()->json(['status' => 200 ]);
        }
    }
    public function mailUnread(Request $request)
    {
        foreach ($request->mails as $mail) {
            Mail::find($mail)->update([
                'unread' => $request->unread
            ]);
        }
        return response()->json(['status' => 200 ]);

    }

    public function mailTrash(Request $request)
    {
        foreach ($request->mails as $mail) {
            Mail::find($mail)->update([
                'mailType' => 'trashed'
            ]);
        }
        return response()->json(['status' => 200 ]);
    }
    public function mailSpam(Request $request)
    {
        foreach ($request->mails as $mail) {
            Mail::find($mail)->update([
                'mailType' => 'spam'
            ]);
            BlacklistMail::create([
                'mail' => Mail::find($mail)->sender
            ]);
        }
        return response()->json(['status' => 200 ]);
    }
}
