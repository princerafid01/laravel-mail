<?php

namespace App\Notifications;

use App\Channels\SMS;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class GeneralNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $msg;
    public $action;
    public $icon;
    public $modal;
    public function __construct($msg, $action = null,$modal = '', $icon = 'notifications')
    {
        $this->msg = $msg;
        $this->action = $action;
        $this->icon = $icon;
        $this->modal = $modal;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', SMS::class,'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'msg' => $this->msg,
            'action'=> $this->action,
            'icon'=> $this->icon,
            'modal'=> $this->modal,
        ];
    }
    public function toSMS($notifiable){
        return [
            'msg' => $this->msg,
            'type'=> 'text',
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id'=> $this,
            'data'=> [
                'msg' => $this->msg,
                'action'=> $this->action,
                'icon'=> $this->icon,
                'modal'=> $this->modal,
            ],
            'read_at' => null,
            'created_at'=> Carbon::now()->toDateTimeString()
        ]);
    }
}
