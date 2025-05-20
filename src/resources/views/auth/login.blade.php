@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('right-top__link')
<a class="header__register-link" href="/register">
    Register
</a>
@endsection


@section('content')

<div class="login__content">
    <div class="login__heading">
        <h2>Login</h2>
    </div>
    <div class="login__content">
        <form action="/login" class="form" method="POST">
            @csrf
            <div class="form__group">
                <label for="email" class="form__label">メールアドレス</label>
                <input type="email" name="email" class="form__input" placeholder="例: test@example.com">
                @error('email')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form__group">
                <label for="password" class="form__label">パスワード</label>
                <input type="password" name="password" class="form__input" placeholder="例: coachtech1106">
                @error('password')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>
            <div class="form__submit-wrapper">
                <button class="form__submit">ログイン</button>
            </div>
        </form>
    </div>
</div>

@endsection