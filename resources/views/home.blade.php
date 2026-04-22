@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="card">
        <h1>Лента новостей</h1>
        <p>Свежие публикации с сайта университета.</p>

        <table class="news-table">
            <thead>
                <tr>
                    <th>Превью</th>
                    <th>Заголовок</th>
                    <th>Автор</th>
                    <th>Дата</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>
                            <a href="{{ route('galery', $article['id']) }}">
                                <img src="{{ $article['preview_image'] }}" alt="preview" class="news-preview">
                            </a>
                        </td>
                        <td>
                            <strong>{{ $article['title'] }}</strong>
                            <div class="news-summary">{{ $article['summary'] }}</div>
                        </td>
                        <td>{{ $article['author'] }}</td>
                        <td>{{ $article['date'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
