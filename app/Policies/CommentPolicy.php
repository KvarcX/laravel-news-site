<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function create(User $user): bool
    {
        return true;
    }

    public function moderate(User $user): bool
    {
        return $user->isModerator();
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $user->isModerator() || $user->id === $comment->user_id;
    }
}
