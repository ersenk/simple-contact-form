<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class YouHaveNewContactFormEmailNotification extends Notification
{
    use Queueable;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return $this->getMessage();
    }

    public function getMessage()
    {
        return (new MailMessage)
            ->subject(config('app.name') . ': new contact form assigned ')
            ->greeting('Hi,')
            ->line('We would like to inform you that you have a new contact form ' . $this->data->first_name . ' '.$this->data->last_name.' has been assigned to you ')
            ->line('Please go to contact form detail to see more information.')
            ->action(config('app.name'), route('frontend.contacts.show', ['contact'=> $this->data]))
            ->line('Thank you')
            ->line(config('app.name') . ' Team')
            ->salutation(' ');
    }
}
