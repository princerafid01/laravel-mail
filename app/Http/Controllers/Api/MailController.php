<?php

namespace App\Http\Controllers\Api;
use App\Attachment;
use App\BlacklistMail;
use App\Http\Controllers\Controller;
use App\Mail;
use App\Mail\SendMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail as RealMail;
use Illuminate\Support\Facades\Storage;
use Webklex\IMAP\Facades\Client;


class MailController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('jwt.auth',['except' => ['download','collectMail','test']]);
    }

    public function collectMail()
    {
        $users = User::all();
        foreach ($users as $user) {

            
            // $oClient = \Webklex\IMAP\Facades\Client::account('default');
            $oClient = new \Webklex\IMAP\Client([
                'host'          => 'sg3plcpnl0071.prod.sin3.secureserver.net',
                'port'          => 993,
                'encryption'    => 'ssl',
                'validate_cert' => true,
                'username'      => $user->email,
                'password'      => $user->email_password,
                'protocol'      => 'imap'
            ]);
            $mail_attachments =[];

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
            $aMessage = $oFolder->messages()->all()->get();
            if ($oFolder->name == 'INBOX') {
                $folder = 'inboxed';
            } else {
                $folder = $oFolder->name;
            }
            foreach($aMessage as $oMessage){
                if(Mail::all()->count() == 0){
                    $mail = Mail::create([
                            'mail' => $user->email,
                            'mail_id' => $oMessage->getMessageNo(),
                            'sender' => $oMessage->getFrom()[0]->mail,
                            'sender_name' => $oMessage->getFrom()[0]->personal,
                            'to' => $oMessage->getTo()[0]->mail,
                            'img' => 'avatar-s-1.png',
                            'subject' =>  $oMessage->getSubject(),
                            'cc' => $oMessage->getCc()[0] ?? '',
                            'bcc' => $oMessage->getBcc()[0] ?? '',
                            'message' => $oMessage->getTextBody(),
                            'isStarred' => false,
                            'time' => date('D M d Y H:m:s O',strtotime($oMessage->getDate())),
                            'mailType' => $folder,
                            'unread' => true,
                     ]);    
                     if($mail){
                            $oMessage->getAttachments()->each(function ($oAttachment) use ($oMessage,$mail) {
                            $oAttachment->save();
                            Attachment::create([
                            'mail_id' => $mail->id ,
                            'attachment_name' => $oAttachment->name ?? '',
                            'storage_name' => $oAttachment->name ?? ''
                            ]);
                         });
                      }  
                    } elseif(!BlacklistMail::where('mail',$oMessage->getFrom()[0]->mail)->count()) {
                        if(Mail::where('mail_id',$oMessage->getMessageNo())->count()){
                            if(Mail::where('mail_id',$oMessage->getMessageNo())->first()->mail != $user->email){
                                $mail = Mail::create([
                                    'mail' => $user->email,
                                    'mail_id' => $oMessage->getMessageNo(),
                                    'sender' => $oMessage->getFrom()[0]->mail,
                                    'sender_name' => $oMessage->getFrom()[0]->personal,
                                    'to' => $oMessage->getTo()[0]->mail,
                                    'img' => 'avatar-s-1.png',
                                    'subject' =>  $oMessage->getSubject(),
                                    'cc' => $oMessage->getCc()[0] ?? '',
                                    'bcc' => $oMessage->getBcc()[0] ?? '',
                                    'message' => $oMessage->getTextBody(),
                                    'isStarred' => false,
                                    'time' => date('D M d Y H:m:s O',strtotime($oMessage->getDate())),
                                    'mailType' => $folder,
                                    'unread' => true,
                                 ]);    
                                 if($mail){
                                        $oMessage->getAttachments()->each(function ($oAttachment) use ($oMessage,$mail) {
                                        $oAttachment->save();
                                        Attachment::create([
                                        'mail_id' => $mail->id ,
                                        'attachment_name' => $oAttachment->name ?? '',
                                        'storage_name' => $oAttachment->name ?? ''
                                        ]);
                                     });
                                  }  
                            }
                        }else{
                                $mail = Mail::create([
                                'mail' => $user->email,
                                'mail_id' => $oMessage->getMessageNo(),
                                'sender' => $oMessage->getFrom()[0]->mail,
                                'sender_name' => $oMessage->getFrom()[0]->personal,
                                'to' => $oMessage->getTo()[0]->mail,
                                'img' => 'avatar-s-1.png',
                                'subject' =>  $oMessage->getSubject(),
                                'cc' => $oMessage->getCc()[0] ?? '',
                                'bcc' => $oMessage->getBcc()[0] ?? '',
                                'message' => $oMessage->getTextBody(),
                                // 'attachments' => $a,
                                'isStarred' => false,
                                // Mon Dec 10 2018 07:46:00 GMT+0000 (GMT)
                                'time' => date('D M d Y H:m:s O',strtotime($oMessage->getDate())),
                                // 'replies' => [],
                                'mailType' => $folder,
                                'unread' => true,
                                // 'content' => $b
                            ]);    
                              if($mail){
                                    $oMessage->getAttachments()->each(function ($oAttachment) use ($oMessage,$mail) {
                                    $oAttachment->save();
                                    Attachment::create([
                                    'mail_id' => $mail->id ,
                                    'attachment_name' => $oAttachment->name ?? '',
                                    'storage_name' => $oAttachment->name ?? ''
                                    ]);
                                 });
                              }
                        }
                    }
                }
            }
        }
    }
    public function index()
    {
        $mails = Mail::with('attachments')->where('deleted',NULL)->get();
        $all_m = [];
        $all_attachments = [];
        foreach ($mails as $mail) {
            if(Auth::user()->email == $mail->mail){
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
                    'attachments' => $mail->attachments,
                    'isStarred' => $mail->isStarred,
                    'time' => date('D M d Y H:m:s O',strtotime($mail->time)),
                    'replies' => [],
                    'mailType' => $mail->mailType,
                    'unread' => $mail->unread,
                ];
            }
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
                    $mail_attachments=[];
                    $mail_attachments_name=[];
                    $b=[];
                    $mail = [];
                    



        //Loop through every Mailbox
        /** @var \Webklex\IMAP\Folder $oFolder */
        foreach($aFolder as $oFolder){

            //Get all Messages of the current Mailbox $oFolder
            /** @var \Webklex\IMAP\Support\MessageCollection $aMessage */
            
            $aMessage = $oFolder->messages()->all()->get();
// echo '<pre>';
//             foreach($aMessage->getAttachments()->items as $item){
//             foreach($item->structure->parameters as $para){
// echo '<pre>';
// var_dump($para->value);
//             echo '</pre>';

//             }
//             }
            // echo '</pre>';
            
            /** @var \Webklex\IMAP\Message $oMessage */
            foreach($aMessage as $oMessage){
                // var_dump($oMessage);
                // $a =[];  
                foreach ($oMessage->getAttachments() as $oAttachment) {
                    $mail_attachments[]=$oAttachment->getContent();
                    $mail_attachments_name[]=$oAttachment->getName();
                    // readfile($file_url)
                }
                echo '<pre>';
var_dump($oMessage->getInReplyTo());
            echo '</pre>';
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
                    'attachments' => $mail_attachments,
                    'isStarred' => false,
                    'labels' => ['private'],
                    // Mon Dec 10 2018 07:46:00 GMT+0000 (GMT)
                    'time' => date('D M d Y H:m:s O',strtotime($oMessage->getDate())),
                    'replies' => [],
                    'mailType' => 'inboxed',
                    'unread' => false,
                    'content' => $b
                ];
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

        if ($request->replyTo) {
            $mailable = new Mailable;
            $mailable->replyTo($request->replyTo);
        }
        if ($request->mailCc) {
            $sent_mail = RealMail::to($request->mailTo)
                                ->cc($request->mailCc)
                                ->send(new SendMail($request,Auth::user()->email));
        }elseif ($request->mailBCC) {
            $sent_mail = RealMail::to($request->mailTo)
                                ->bcc($request->mailBCC)
                                ->send(new SendMail($request,Auth::user()->email));
        } elseif ($request->mailCc && $request->mailBCC) {
            $sent_mail = RealMail::to($request->mailTo)
                                ->cc($request->mailCc)
                                ->bcc($request->mailBCC)
                                ->send(new SendMail($request,Auth::user()->email));
        } else{
            $sent_mail = RealMail::to($request->mailTo)
                                ->send(new SendMail($request,Auth::user()->email));
        }

        
        $mail = Mail::create(
        [
                'mail' => Auth::user()->email,
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
// Compose Mail
    public function draftMail(Request $request)
    {
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
                    'mailType' => 'drafted',
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

    public function mailDraft(Request $request)
    {
        foreach ($request->mails as $mail) {
            Mail::find($mail)->update([
                'mailType' => 'drafted'
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

    public function download($file)
    {
        return Storage::disk('local_public')->download($file);
    }

    public function findMail($id)
    {
        return response()->json(Mail::find($id));
    }

    public function mailDelete(Request $request)
    {
        foreach ($request->mails as $mail) {
            Mail::find($mail)->update([
                'deleted' => 1
            ]);
        }
    }
}
