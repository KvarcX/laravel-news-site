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
    </article>

    <section class="comments">
        <h2>Комментарии</h2>

        @php
            $approved = $article->approvedComments;
        @endphp

        @if ($approved->isEmpty())
            <p class="comments__empty">Пока нет одобренных комментариев. Будьте первым!</p>
        @else
            @foreach ($approved as $comment)
                <div class="comment">
                    <div class="comment__meta">
                        <strong>{{ $comment->user->name }}</strong>
                        <span>{{ $comment->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    <p class="comment__body">{{ $comment->body }}</p>
                    @can('delete', $comment)
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                              class="inline-form" onsubmit="return confirm('Удалить комментарий?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="link-danger">Удалить</button>
                        </form>
                    @endcan
                </div>
            @endforeach
        @endif

        @auth
            <form action="{{ route('comments.store', $article) }}" method="POST" class="comment-form" novalidate>
                @csrf
                <h3>Оставить комментарий</h3>
                <p class="comment-form__note">После отправки комментарий появится после проверки модератором.</p>

                @if ($errors->any())
                    <div class="form-errors">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <textarea name="body" rows="4" placeholder="Ваш комментарий...">{{ old('body') }}</textarea>
                <button type="submit" class="btn-primary">Отправить</button>
            </form>
        @else
            <p class="comment-form__note">
                Чтобы оставить комментарий, <a href="{{ route('login') }}">войдите</a> или
                <a href="{{ route('signin') }}">зарегистрируйтесь</a>.
            </p>
        @endauth
    </section>
@endsection
