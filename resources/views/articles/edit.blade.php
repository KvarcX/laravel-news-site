@extends('layouts.app')

@section('title', 'Редактирование: ' . $article->title)

@section('content')
    <h1>Редактирование новости</h1>

    @if ($errors->any())
        <div class="form-errors">
            Проверьте правильность заполнения полей:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('articles.update', $article) }}" class="signin-form" novalidate>
        @csrf
        @method('PUT')

        <div class="form-row">
            <label for="title">Заголовок</label>
            <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}">
        </div>

        <div class="form-row">
            <label for="image">Путь к обложке</label>
            <input type="text" id="image" name="image" value="{{ old('image', $article->image) }}">
        </div>

        <div class="form-row">
            <label for="excerpt">Краткое описание</label>
            <textarea id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $article->excerpt) }}</textarea>
        </div>

        <div class="form-row">
            <label for="body">Полный текст</label>
            <textarea id="body" name="body" rows="10">{{ old('body', $article->body) }}</textarea>
        </div>

        <div class="form-row">
            <button type="submit" class="btn-primary">Сохранить изменения</button>
            <a href="{{ route('articles.show', $article) }}">Отмена</a>
        </div>
    </form>
@endsection
