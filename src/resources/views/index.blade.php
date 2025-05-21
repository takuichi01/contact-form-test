@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('right-top__link')
@endsection

@section('content')
<div class="contact">
    <div class="contact__heading">
        <h2>Contact</h2>
    </div>

    <form class="form" action="{{ route('contact.confirm') }}" method="post">
        @csrf
        <div class="form__row">
            <label class="form__label">お名前 <span class="form__required">※</span></label>
            <div class="form__group--double">
                <input type="text" class="form__input" name="last_name" placeholder="例: 山田"
                    value="{{ $data['last_name'] ?? old('last_name') ?? ''}}">
                <input type="text" class="form__input" name="first_name" placeholder="例: 太郎"
                    value="{{ $data['first_name'] ?? old('first_name') ?? ''}}">
            </div>
        </div>
        <div class="error-message">
            @error('last_name')
            {{$message}}
            @enderror
        </div>
        <div class="error-message">
            @error('first_name')
            {{$message}}
            @enderror
        </div>

        <div class="form__row">
            <label class="form__label">性別 <span class="form__required">※</span></label>
            <div class="form__radio-group">
                @php
                $gender = $data['gender'] ?? '1'; // デフォルトは男性
                @endphp
                <label><input type="radio" name="gender" value="1" {{ $gender=='1' ? 'checked' : '' }} selected>
                    男性</label>
                <label><input type="radio" name="gender" value="2" {{ $gender=='2' ? 'checked' : '' }}> 女性</label>
                <label><input type="radio" name="gender" value="3" {{ $gender=='3' ? 'checked' : '' }}> その他</label>
            </div>
        </div>

        <div class="error-message">
            @error('gender')
            {{$message}}
            @enderror
        </div>

        <div class="form__row">
            <label class="form__label">メールアドレス <span class="form__required">※</span></label>
            <input type="email" class="form__input" name="email" placeholder="例: test@example.com"
                value="{{ $data['email'] ?? old('email') ?? ''}}">
        </div>
        <div class="error-message">
            @error('email')
            {{$message}}
            @enderror
        </div>

        <div class="form__row">
            <label class="form__label">電話番号</label>
            <div class="form__group--triple">
                <input type="text" class="form__input" name="first_tel" placeholder="080"
                    value="{{ $data['first_tel'] ?? old('first_tel') ?? ''}}">
                <input type="text" class="form__input" name="second_tel" placeholder="1234"
                    value="{{ $data['second_tel'] ?? old('second_tel') ?? ''}}">
                <input type="text" class="form__input" name="third_tel" placeholder="5678"
                    value="{{ $data['third_tel'] ?? old('third_tel') ?? ''}}">
            </div>
        </div>
        <div class="error-message">
            @if ($errors->has('first_tel')|| $errors->has('second_tel')||$errors->has('third_tel'))
            {{ $errors->first('first_tel') ?? $errors->first('second_tel') ?? $errors->first('third_tel')}}
            @endif
        </div>

        <div class="form__row">
            <label class="form__label">住所 <span class="form__required">※</span></label>
            <input type="text" class="form__input" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3"
                value="{{ $data['address'] ?? old('address') ?? ''}}">
        </div>
        <div class="error-message">
            @error('address')
            {{$message}}
            @enderror
        </div>

        <div class="form__row">
            <label class="form__label">建物名</label>
            <input type="text" class="form__input" name="building" placeholder="例: 千駄ヶ谷マンション101"
                value="{{ $data['building'] ?? old('building') ?? ''}}">
        </div>
        <div class="error-message">
            @error('building')
            {{$message}}
            @enderror
        </div>

        <div class="form__row">
            <label class="form__label">お問い合わせの種類 <span class="form__required">※</span></label>
            <select class="form__select" name="category" required>
                <option value="">選択してください</option>
                @foreach ($categories as $category)
                <option value="{{ $category->content }}" @if (($data['category'] ?? '' )===$category->content) selected
                    @endif>
                    {{ $category->content }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="error-message">
            @error('category')
            {{$message}}
            @enderror
        </div>

        <div class="form__row">
            <label class="form__label">お問い合わせ内容 <span class="form__required">※</span></label>
            <textarea class="form__textarea" rows="5" name="detail"
                placeholder="お問い合わせ内容をご記載ください">{{ $data['detail'] ?? old('detail') ?? ''}}</textarea>
        </div>
        <div class="error-message">
            @error('detail')
            {{$message}}
            @enderror
        </div>

        <div class="form__row form__row--center">
            <button type="submit" class="form__submit">確認画面</button>
        </div>
    </form>

    @endsection