@extends('layouts.app')

@section('title', 'Галерея')

@section('content')
    <div class="card">
        <h1>{{ $article['title'] }}</h1>
        <p class="news-summary">{{ $article['author'] }}, {{ $article['date'] }}</p>
        <p>{{ $article['summary'] }}</p>

        <img src="{{ $article['full_image'] }}" alt="full" class="news-full">

        <p style="margin-top:16px;"><a href="{{ route('home') }}">← Назад к новостям</a></p>
    </div>
@endsection
