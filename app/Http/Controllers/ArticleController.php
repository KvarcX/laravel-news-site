<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
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
        return view('articles.create');
    }

    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']) . '-' . time();

        $article = Article::create($data);

        return redirect()
            ->route('articles.show', $article)
            ->with('status', 'Новость создана');
    }

    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article]);
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']) . '-' . $article->id;

        $article->update($data);

        return redirect()
            ->route('articles.show', $article)
            ->with('status', 'Новость обновлена');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()
            ->route('articles.index')
            ->with('status', 'Новость удалена');
    }
}
