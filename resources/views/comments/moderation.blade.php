@extends('layouts.app')

@section('title', 'Модерация комментариев')

@section('content')
    <h1>Модерация комментариев</h1>

    @if (session('status'))
        <div class="flash-success">{{ session('status') }}</div>
    @endif

    <p>Всего на модерации: {{ $comments->total() }}.</p>

    @if ($comments->isEmpty())
        <div class="card" style="margin-top: 16px;">
            Нет комментариев, ожидающих проверки. Все одобрены.
        </div>
    @else
        <div class="moderation-list">
            @foreach ($comments as $comment)
                <div class="moderation-item">
                    <div class="moderation-item__head">
                        <div>
                            <strong>{{ $comment->user->name }}</strong>
                            <span class="moderation-item__meta">
                                {{ $comment->created_at->format('d.m.Y H:i') }}
                            </span>
                        </div>
                        <a href="{{ route('articles.show', $comment->article) }}" class="moderation-item__article">
                            к статье: {{ \Illuminate\Support\Str::limit($comment->article->title, 60) }}
                        </a>
                    </div>

                    <p class="moderation-item__body">{{ $comment->body }}</p>

                    <div class="moderation-item__actions">
                        <form action="{{ route('moderation.comments.approve', $comment) }}" method="POST" class="inline-form">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-approve">✓ Одобрить</button>
                        </form>
                        <form action="{{ route('moderation.comments.reject', $comment) }}" method="POST" class="inline-form" onsubmit="return confirm('Отклонить и удалить?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-reject">✕ Отклонить</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($comments->hasPages())
            <nav class="pagination">
                @if ($comments->onFirstPage())
                    <span class="disabled">← Назад</span>
                @else
                    <a href="{{ $comments->previousPageUrl() }}">← Назад</a>
                @endif

                @for ($page = 1; $page <= $comments->lastPage(); $page++)
                    @if ($page === $comments->currentPage())
                        <span class="active">{{ $page }}</span>
                    @else
                        <a href="{{ $comments->url($page) }}">{{ $page }}</a>
                    @endif
                @endfor

                @if ($comments->hasMorePages())
                    <a href="{{ $comments->nextPageUrl() }}">Вперёд →</a>
                @else
                    <span class="disabled">Вперёд →</span>
                @endif
            </nav>
        @endif
    @endif
@endsection
