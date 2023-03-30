<?php

namespace App\Notifications;

use App\Models\TweetComment as ModelsTweetComment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TweetComment extends Notification
{
    use Queueable;

    public $comments;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ModelsTweetComment $comments)
    {
        $this->comments = $comments;
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
            'id' => $this->comments->id,
            'user' => $this->comments->user,
            'tweet' => $this->comments->tweet,
            'text' => $this->comments->text,
        ];
    }
}
