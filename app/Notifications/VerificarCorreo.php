<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class VerificarCorreo extends Notification
{
    use Queueable;


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
        $url = URL::temporarySignedRoute(
            'correo.verificar',
            now()->addMinutes(30),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->Correo),
            ]
        );

        return (new MailMessage)
            ->subject('Verifica tu correo electronico')
            ->greeting('Hola, ' . $notifiable->Nombre)
            ->line('Necesitamos confirmar que tienes acceso a este direccion.')
            ->action('Verificar mi correo', $url)
            ->line('Este mensaje caduca en 30 minutos.')
            ->line('si no solicitaste esta verificacion, puedes ignorar este mensaje.');
    }
}
