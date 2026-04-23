@extends('layouts.app')

@section('title', $article->title)

@section('content')
    @if (session('status'))
        <div class="flash-success">{{ session('status') }}</div>
    @endif

    <article class="article-full">
        @if ($article->image)
            <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="article-full__img">
        @endif
        <h1>{{ $article->title }}</h1>
        <p class="article-card__meta">Опубликовано {{ $article->created_at->format('d.m.Y H:i') }}</p>
        <p class="article-full__excerpt"><em>{{ $article->excerpt }}</em></p>
        <div class="article-full__body">
            @foreach (explode("\n\n", $article->body) as $para)
                <p>{{ $para }}</p>
            @endforeach
        </div>

        <div class="article-card__actions">
            <a href="{{ route('articles.index') }}">← Назад к списку</a>
            @auth
                <a href="{{ route('articles.edit', $article) }}">Редактировать</a>
                <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline-form" onsubmit="return confirm('Удалить новость?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="link-danger">Удалить</button>
                </form>
            @endauth
        </div>
    </article>
@endsection
