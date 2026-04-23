@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <div class="card" style="max-width: 480px; margin: 0 auto;">
        <h1>Регистрация</h1>
        <p>Заполните форму, чтобы зарегистрироваться на сайте.</p>

        @if ($errors->any())
            <div class="form-errors">
                <strong>Проверьте заполнение формы:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('signin.store') }}" method="POST" class="signin-form" novalidate>
            @csrf

            <div class="form-row">
                <label for="name">Имя</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}">
            </div>

            <div class="form-row">
                <label for="email">E-mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="form-row">
                <label for="password">Пароль</label>
                <input id="password" type="password" name="password">
            </div>

            <div class="form-row">
                <label for="password_confirmation">Повторите пароль</label>
                <input id="password_confirmation" type="password" name="password_confirmation">
            </div>

            <button type="submit" class="btn-primary">Зарегистрироваться</button>
        </form>
    </div>
@endsection
