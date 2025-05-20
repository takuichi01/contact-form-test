@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks">
    <div class="thanks__message">
        <h2>お問い合わせありがとうございました</h2>
        <p>送信内容を受け付けました。確認の上、担当者よりご連絡いたします。</p>
    </div>
    <div class="thanks__back">
        <a href="{{ route('contact.index') }}" class="thanks__button">トップへ戻る</a>
    </div>
</div>
@endsection