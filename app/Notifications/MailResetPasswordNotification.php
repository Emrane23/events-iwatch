<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Auth\Notifications\ResetPassword;

class MailResetPasswordNotification extends ResetPassword
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        parent::__construct($token) ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $link = url( "/reset-password/".$this->token );
        return ( new MailMessage )
            ->subject( 'Réinitialisation de mot de passe' )
            ->line( "Vous recevez cet e-mail car nous avons reçu une demande de réinitialisation du mot de passe pour votre compte." )
            ->action( 'Réinitialiser le mot de passe', $link )
            ->line( "Ce lien de réinitialisation de mot de passe expirera dans ".config('auth.passwords.users.expire')." minutes" )
            ->line( "Si vous n'avez pas demandé de réinitialisation de mot de passe, aucune autre action n'est requise." );    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}