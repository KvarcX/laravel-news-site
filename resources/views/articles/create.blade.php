@extends('layouts.app')

@section('title', 'Новая новость')

@section('content')
    <h1>Добавить новость</h1>

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

    <form method="POST" action="{{ route('articles.store') }}" class="signin-form" novalidate>
        @csrf
        <div class="form-row">
            <label for="title">Заголовок</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}">
        </div>

        <div class="form-row">
            <label for="image">Путь к обложке (например images/1-preview.jpg)</label>
            <input type="text" id="image" name="image" value="{{ old('image') }}">
        </div>

        <div class="form-row">
            <label for="excerpt">Краткое описание</label>
            <textarea id="excerpt" name="excerpt" rows="3">{{ old('excerpt') }}</textarea>
        </div>

        <div class="form-row">
            <label for="body">Полный текст</label>
            <textarea id="body" name="body" rows="10">{{ old('body') }}</textarea>
        </div>

        <div class="form-row">
            <button type="submit" class="btn-primary">Сохранить</button>
            <a href="{{ route('articles.index') }}">Отмена</a>
        </div>
    </form>
@endsection
