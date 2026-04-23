<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Mail\NewArticleNotification;
use App\Models\Article;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderByDesc('id')->paginate(10);

        return view('articles.index', ['articles' => $articles]);
    }

    public function show(Article $article)
    {
        return view('articles.show', ['article' => $article]);
    }

    public function create()
    {
        $this->authorize('create', Article::class);

        return view('articles.create');
    }

    public function store(StoreArticleRequest $request)
    {
        $this->authorize('create', Article::class);

        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']) . '-' . time();

        $article = Article::create($data);

        $moderators = User::whereHas('role', function ($q) {
            $q->where('name', Role::MODERATOR);
        })->pluck('email');

        if ($moderators->isNotEmpty()) {
            Mail::to($moderators->all())->send(new NewArticleNotification($article));
        }

        return redirect()
            ->route('articles.show', $article)
            ->with('status', 'Новость создана и рассылка отправлена');
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        return view('articles.edit', ['article' => $article]);
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);

        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']) . '-' . $article->id;

        $article->update($data);

        return redirect()
            ->route('articles.show', $article)
            ->with('status', 'Новость обновлена');
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();

        return redirect()
            ->route('articles.index')
            ->with('status', 'Новость удалена');
    }
}
