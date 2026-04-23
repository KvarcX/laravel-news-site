<?php

namespace App\Jobs;

use App\Mail\NewArticleNotification;
use App\Models\Article;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendNewArticleNotificationJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;
    public int $backoff = 10;

    public function __construct(public Article $article) {}

    public function handle(): void
    {
        $moderators = User::whereHas('role', function ($q) {
            $q->where('name', Role::MODERATOR);
        })->pluck('email');

        if ($moderators->isEmpty()) {
            return;
        }

        Mail::to($moderators->all())->send(new NewArticleNotification($this->article));
    }
}
