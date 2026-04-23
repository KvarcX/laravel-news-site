<?php

namespace App\Mail;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewArticleNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Article $article)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Новая новость на сайте: ' . $this->article->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.new-article-notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
