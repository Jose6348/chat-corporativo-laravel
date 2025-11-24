<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TwoFactorCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $code;
    public string $userEmail;

    /**
     * Create a new message instance.
     */
    public function __construct(string $code, string $userEmail)
    {
        $this->code = $code;
        $this->userEmail = $userEmail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Usa o email configurado no .env como remetente
        // O email será enviado PARA o email do usuário
        $fromAddress = env('MAIL_FROM_ADDRESS', 'noreply@example.com');
        $fromName = env('MAIL_FROM_NAME', config('app.name', 'Synkro Chat'));
        
        return new Envelope(
            from: new Address($fromAddress, $fromName),
            subject: 'Seu Código de Acesso - Synkro Chat',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Aponta para a view (HTML) do e-mail
        return new Content(
            view: 'emails.two-factor-code', 
        );
    }
}