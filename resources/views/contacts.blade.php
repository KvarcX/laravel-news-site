@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
    <div class="card">
        <h1>Контакты</h1>
        <p>Наши контактные данные:</p>
        <ul class="contacts-list">
            @foreach ($contacts as $contact)
                <li><strong>{{ $contact['label'] }}:</strong> {{ $contact['value'] }}</li>
            @endforeach
        </ul>
    </div>
@endsection
