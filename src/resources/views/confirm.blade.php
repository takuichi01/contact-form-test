@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm">
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>

    <div class="confirm-form">
        {{-- 内容表示部分 --}}
        <div class="confirm-form__row">
            <p class="confirm-form__label">お名前</p>
            <p class="confirm-form__value">{{ $data['last_name'] }} {{ $data['first_name'] }}</p>
        </div>

        <div class="confirm-form__row">
            <p class="confirm-form__label">性別</p>
            <p class="confirm-form__value">
                @switch($data['gender'])
                @case('1') 男性 @break
                @case('2') 女性 @break
                @case('3') その他 @break
                @default 未選択
                @endswitch
            </p>
        </div>

        <div class="confirm-form__row">
            <p class="confirm-form__label">メールアドレス</p>
            <p class="confirm-form__value">{{ $data['email'] }}</p>
        </div>

        <div class="confirm-form__row">
            <p class="confirm-form__label">電話番号</p>
            <p class="confirm-form__value">{{ $data['first_tel'] }}-{{ $data['second_tel'] }}-{{ $data['third_tel'] }}
            </p>
        </div>

        <div class="confirm-form__row">
            <p class="confirm-form__label">住所</p>
            <p class="confirm-form__value">{{ $data['address'] }}</p>
        </div>

        <div class="confirm-form__row">
            <p class="confirm-form__label">建物名</p>
            <p class="confirm-form__value">{{ $data['building'] }}</p>
        </div>

        <div class="confirm-form__row">
            <p class="confirm-form__label">お問い合わせの種類</p>
            <p class="confirm-form__value">{{ $data['category'] }}</p>
        </div>

        <div class="confirm-form__row">
            <p class="confirm-form__label">お問い合わせ内容</p>
            <p class="confirm-form__value">{{ $data['detail'] }}</p>
        </div>

        {{-- ボタン行（flexで横並び） --}}
        <div class="confirm-form__row confirm-form__row--buttons" style="display: flex; gap: 1rem;">
            {{-- 送信ボタン（submit処理へ） --}}
            <form action="/submit" method="POST">
                @csrf
                @foreach ($data as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <button type="submit" class="confirm-form__button confirm-form__button--submit">送信する</button>
            </form>
            {{-- 修正ボタン（POST / に戻す） --}}
            <form action="{{ route('contact.index') }}" method="POST">
                @csrf
                @foreach ($data as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <button type="submit" class="confirm-form__button confirm-form__button--back">修正する</button>
            </form>
        </div>
    </div>
</div>
@endsection