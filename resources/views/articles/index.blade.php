@extends('layouts.app')

@section('title', 'Новости')

@section('content')
    <div class="articles-header">
        <h1>Все новости</h1>
        @can('create', App\Models\Article::class)
            <a href="{{ route('articles.create') }}" class="btn-primary">+ Добавить новость</a>
        @endcan
    </div>

    @if (session('status'))
        <div class="flash-success">{{ session('status') }}</div>
    @endif

    <p>Всего записей в базе: {{ $articles->total() }}. Страница {{ $articles->currentPage() }} из {{ $articles->lastPage() }}.</p>

    <div class="articles-list">
        @foreach ($articles as $article)
            <article class="article-card">
                @if ($article->image)
                    <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="article-card__img">
                @endif
                <div class="article-card__body">
                    <h2 class="article-card__title">
                        <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                    </h2>
                    <p class="article-card__meta">{{ $article->created_at->format('d.m.Y H:i') }}</p>
                    <p class="article-card__excerpt">{{ $article->excerpt }}</p>
                    <div class="article-card__actions">
                        <a href="{{ route('articles.show', $article) }}">Читать</a>
                        @can('update', $article)
                            <a href="{{ route('articles.edit', $article) }}">Редактировать</a>
                        @endcan
                        @can('delete', $article)
                            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline-form" onsubmit="return confirm('Удалить новость?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="link-danger">Удалить</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    @if ($articles->hasPages())
        <nav class="pagination">
            @if ($articles->onFirstPage())
                <span class="disabled">← Назад</span>
            @else
                <a href="{{ $articles->previousPageUrl() }}">← Назад</a>
            @endif

            @for ($page = 1; $page <= $articles->lastPage(); $page++)
                @if ($page === $articles->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $articles->url($page) }}">{{ $page }}</a>
                @endif
            @endfor

            @if ($articles->hasMorePages())
                <a href="{{ $articles->nextPageUrl() }}">Вперёд →</a>
            @else
                <span class="disabled">Вперёд →</span>
            @endif
        </nav>
    @endif
@endsection
