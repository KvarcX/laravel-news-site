<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $this->authorize('create', Comment::class);

        $data = $request->validate([
            'body' => ['required', 'string', 'min:5', 'max:2000'],
        ], [
            'body.required' => 'Комментарий не может быть пустым',
            'body.min'      => 'Комментарий должен быть не короче :min символов',
        ]);

        $article->comments()->create([
            'user_id'     => $request->user()->id,
            'body'        => $data['body'],
            'is_approved' => false,
        ]);

        return redirect()
            ->route('articles.show', $article)
            ->with('status', 'Комментарий отправлен на модерацию');
    }

    public function moderation()
    {
        $this->authorize('moderate', Comment::class);

        $comments = Comment::with(['user', 'article'])
            ->pending()
            ->latest()
            ->paginate(15);

        return view('comments.moderation', ['comments' => $comments]);
    }

    public function approve(Comment $comment)
    {
        $this->authorize('moderate', Comment::class);

        $comment->update(['is_approved' => true]);

        return back()->with('status', 'Комментарий одобрен');
    }

    public function reject(Comment $comment)
    {
        $this->authorize('moderate', Comment::class);

        $comment->delete();

        return back()->with('status', 'Комментарий отклонён и удалён');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $article = $comment->article;
        $comment->delete();

        return redirect()
            ->route('articles.show', $article)
            ->with('status', 'Комментарий удалён');
    }
}
