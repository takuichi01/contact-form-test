@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('right-top__link')
<form action="/logout" class="header__login" method="post">
    @csrf
    <button class="header__logout-link">logout</button>
</form>
@endsection


@section('content')
<header class="admin__header">
    <h2 class="admin__subtitle">Admin</h2>
</header>

<form method="GET" action="/admin" class="search-form">
    <input class="search-form__input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください"
        value="{{ request('keyword') }}">
    <select class="search-form__select" name="gender">
        <option value="">性別</option>
        <option value="1" @selected(request('gender')==1)>男性</option>
        <option value="2" @selected(request('gender')==2)>女性</option>
    </select>
    <select class="search-form__select" name="category_id">
        <option value="" selected>お問い合わせの種類</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}">
            {{$category->id}}.{{ $category->content }}
        </option>
        @endforeach
    </select>
    <input class="search-form__input" type="date" name="created_at" value="{{ request('created_at') }}">
    <button type="submit" class="search-form__button">検索</button>
    <a href="/admin" class="search-form__button search-form__button--reset">リセット</a>
</form>

<form method="POST" action="/admin">
    @csrf
    <button class="admin__export-button">エクスポート</button>
</form>

@if ($contacts->lastPage() > 1)
<ul class="pagination">
    @for ($i = 1; $i <= $contacts->lastPage(); $i++)
        <li class="pagination__item {{ ($contacts->currentPage() == $i) ? 'active' : '' }}">
            <a href="{{ $contacts->url($i) }}">{{ $i }}</a>
        </li>
        @endfor

        {{-- 最後のページでなければ「>>」を表示 --}}
        @if ($contacts->currentPage() < $contacts->lastPage())
            <li class="pagination__item">
                <a href="{{ $contacts->url($contacts->currentPage() + 1) }}">>></a>
            </li>
            @endif
</ul>
@endif
<table class="contact-table">
    <thead class="contact-table__head">
        <tr class="contact-table__row">
            <th class="contact-table__header">お名前</th>
            <th class="contact-table__header">性別</th>
            <th class="contact-table__header">メールアドレス</th>
            <th class="contact-table__header">お問い合わせの種類</th>
            <th class="contact-table__header"></th>
        </tr>
    </thead>
    <tbody class="contact-table__body">
        @foreach ($contacts as $contact)
        <tr class="contact-table__row">
            <td class="contact-table__data">{{ $contact->last_name }} {{ $contact->first_name }}</td>
            <td class="contact-table__data">
                @if ($contact->gender === 1)
                男性
                @elseif ($contact->gender === 2)
                女性
                @else
                その他
                @endif
            </td>
            <td class="contact-table__data">{{ $contact->email }}</td>
            <td class="contact-table__data">
                {{ $contact->category->content ?? '未設定' }}
            </td>
            <td class="contact-table__data">
                <button type="button" class="contact-table__link show-modal" data-contact='@json($contact->toArray())'
                    data-category="{{ $contact->category->content ?? '未設定' }}">
                    詳細
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- モーダル背景 -->
<div id="modal-overlay" class="modal-overlay hidden"></div>

<!-- モーダル本体 -->
<div id="modal" class="modal hidden">
    <div class="modal__content">
        <span id="modal-close" class="modal__close">&times;</span>
        <h2>お問い合わせ詳細</h2>
        <div id="modal-body"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('modal');
        const overlay = document.getElementById('modal-overlay');
        const close = document.getElementById('modal-close');
        const modalBody = document.getElementById('modal-body');

        document.querySelectorAll('.show-modal').forEach(button => {
            button.addEventListener('click', function () {
                const contact = JSON.parse(this.dataset.contact);
                const category = this.dataset.category;

                let genderText = 'その他';
                if (contact.gender == 1) genderText = '男性';
                else if (contact.gender == 2) genderText = '女性';

                let html = `
                    <p><strong>名前:</strong> ${contact.last_name} ${contact.first_name}</p>
                    <p><strong>性別:</strong> ${genderText}</p>
                    <p><strong>メール:</strong> ${contact.email}</p>
                    <p><strong>電話番号:</strong> ${contact.tel}</p>
                    <p><strong>住所:</strong> ${contact.address}</p>
                    <p><strong>カテゴリ:</strong> ${category}</p>
                    <p><strong>お問い合わせ内容:</strong><br>${contact.detail}</p>
                `;

                modalBody.innerHTML = html;
                modal.classList.remove('hidden');
                overlay.classList.remove('hidden');
            });
        });

        [overlay, close].forEach(el => {
            el.addEventListener('click', () => {
                modal.classList.add('hidden');
                overlay.classList.add('hidden');
            });
        });
    });
</script>
@endsection