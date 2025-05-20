@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('right-top__link')
<a class="header__login-link" href="/login">
    login
</a>
@endsection


@section('content')

<div class="register__content">
    <div class="register__heading">
        <h2>Register</h2>
    </div>
    <div class="register__content">
        <form action="/register" class="form" method="POST">
            @csrf
            <div class="form__group">
                <label for="name" class="form__label">お名前</label>
                <input type="text" name="name" class="form__input" placeholder="例: 山田 太郎">
                @error('name')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

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

            <div class="form__group">
                <label for="password" class="form__label">パスワード確認</label>
                <input type="password" name="password_confirmation" required class="form__input"
                    placeholder="例: coachtech1106">
                @error('password_confirmation')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>
            <div class="form__submit-wrapper">
                <button class="form__submit">登録</button>
            </div>
        </form>
    </div>
</div>

@endsection