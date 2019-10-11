<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $fromMail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$fromMail)
    {
        $this->data = $data;
        $this->fromMail = $fromMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('mail.mail');
        $email->from($this->fromMail);
        // $attachments =[];
        if($this->data->file){
            foreach ($this->data->file as $vala) {
                $attachments = [$vala->getRealPath() =>
                    [
                        'as' => $vala->getClientOriginalName(),
                        'mime' => $vala->getClientMimeType(),
                    ]
                ];
                // $attachments is an array with file paths of attachments
                foreach($attachments as $filePath => $fileParameters){
                    $email->attach($filePath, $fileParameters);
                }
            }
        }
        
        return $email;




        // $email = $this->view('mail.mail');
        // if($this->data->file){
        //     // $attachments = [];
        //     foreach ($this->data->file as $vala) {
        //         $email->attach($vala);
        //         // $attachments[] = $vala->getRealPath();
        //     }
        // }
        // return $email;
    }
}
