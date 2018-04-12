<?php

namespace App\Notifications;
use Illuminate\Support\Facades\Log;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notifiable;

class sysNotification extends Notification  
{
   // use Queueable;
    private $notification;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($sysNotification)
    {
        //
        // log::info($sysNotification);
        $this->notification=$sysNotification;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        log::info( (array)$notifiable);
        
        return [
            'title' => $this->notification['title'],
            'data' => $this->notification['data'],
        ];
    }
    
/**
 * Get the broadcastable representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return BroadcastMessage
 */
public function toBroadcast($notifiable)
{
    return new BroadcastMessage( [
        'sysNotification_id' => $this->notification->id,
        'data' => $this->notification->data,
    ]);
}
}
