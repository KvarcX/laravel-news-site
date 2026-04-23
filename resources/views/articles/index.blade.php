@extends('layouts.app')

@section('title', 'Новости')

@section('content')
    <h1>Все новости</h1>
    <p>Всего записей в базе: {{ count($articles) }}</p>

    <div class="articles-list">
        @foreach ($articles as $article)
            <article class="article-card">
                @if ($article->image)
                    <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="article-card__img">
                @endif
                <div class="article-card__body">
                    <h2 class="article-card__title">{{ $article->title }}</h2>
                    <p class="article-card__meta">{{ $article->created_at->format('d.m.Y H:i') }}</p>
                    <p class="article-card__excerpt">{{ $article->excerpt }}</p>
                </div>
            </article>
        @endforeach
    </div>
@endsection
