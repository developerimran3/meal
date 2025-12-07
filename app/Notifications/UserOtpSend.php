<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserOtpSend extends Notification
{
    use Queueable;

    private $name;
    private $otp;
    private $active_token = null;

    /**
     * Create a new notification instance.
     */
    public function __construct($userEmail)
    {
        $this->name = $userEmail->name;
        $this->otp = $userEmail->otp;
        $this->active_token = $userEmail->active_token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hello:'  . ' ' . $this->name)
            ->line('Your OTP:' . ' ' . $this->otp)
            ->line('Please Change 1 Min')
            ->action('Reset Your Password Link', url('/reset-password/'  . $this->active_token))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
