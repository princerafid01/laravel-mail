<?php

namespace App\Console\Commands;

use App\Attachment;
use App\Mail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class collectMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'collect:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect Mail of  mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $oClient = \Webklex\IMAP\Facades\Client::account('default');
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
        if(!Mail::where('mail_id',$oMessage->getMessageNo())->count()){

        $mail = Mail::create([
        'mail_id' => $oMessage->getMessageNo(),
        'sender' => $oMessage->getFrom()[0]->mail,
        'sender_name' => $oMessage->getFrom()[0]->personal,
        'to' => $oMessage->getTo()[0]->mail,
        'img' => 'avatar-s-1.png',
        'subject' =>  $oMessage->getSubject(),
        'cc' => $oMessage->getCc()[0] ?? '',
        'bcc' => $oMessage->getBcc()[0] ?? '',
        'message' => $oMessage->getBodies()['text']->content,
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
