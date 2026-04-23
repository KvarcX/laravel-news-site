@extends('layouts.app')

@section('title', 'Вход')

@section('content')
    <h1>Вход</h1>

    @if ($errors->any())
        <div class="form-errors">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}" class="signin-form" novalidate>
        @csrf

        <div class="form-row">
            <label for="email">E-mail</label>
            <input type="text" id="email" name="email" value="{{ old('email') }}">
        </div>

        <div class="form-row">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="form-row">
            <label class="inline-label">
                <input type="checkbox" name="remember" value="1"> Запомнить меня
            </label>
        </div>

        <div class="form-row">
            <button type="submit" class="btn-primary">Войти</button>
            <a href="{{ route('signin') }}">Нет аккаунта? Зарегистрируйтесь</a>
        </div>
    </form>
@endsection
