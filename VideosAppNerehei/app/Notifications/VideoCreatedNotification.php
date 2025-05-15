<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VideoCreatedNotification extends Notification
{
    use Queueable;

    public $video;

    public function __construct($video)
    {
        $this->video = $video;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Video Created')
            ->line('Nom: ' . $this->video->title)
            ->action('View Video', url('/videos/' . $this->video->id))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'video_id' => $this->video->id,
            'title' => $this->video->title,
        ];
    }
}
