@extends('layouts.app')

@section('title')
<title>お問い合わせフォーム入力ページ</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('button')
<div></div>
@endsection

@section('content-title')
<p class="content-title">Contact</p>
@endsection

@section('content')
<div class="contact__content">
    <form class="contact-form" action="/confirm" method="post">
    @csrf
        <div class="form__group">
            <div class="form__group-title">
                <label for="name">お名前 <span class="note">※</span></label>
            </div>
            <div class="form__group-content">
                <div class="name-group">
                    <input type="text" name="first_name" value="{{ old('first_name', $contact['first_name'] ?? '') }}" placeholder="例: 山田">
                    <input type="text" name="last_name" value="{{ old('last_name', $contact['last_name'] ?? '') }}" placeholder="例: 太郎">
                </div>
                <div class="name-group__alert">
                    <div class="contact__alert--danger">
                        {{ $errors->first('first_name') }}
                    </div>
                    <div class="contact__alert--danger">
                        {{ $errors->first('last_name') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label for="gender">性別 <span class="note">※</span></label>
            </div>
            <div class="form__group-content">
                <div class="radio-group">
                    <div class = radio-item>
                        <input type="radio" name="gender" value="1" {{ (old('gender', $contact['gender'] ?? '') == 1) ? 'checked' : '' }} checked> 男性
                    </div>
                    <div class = radio-item>
                        <input type="radio" name="gender" value="2" {{ (old('gender', $contact['gender'] ?? '') == 2) ? 'checked' : '' }}> 女性
                    </div>
                    <div class = radio-item>
                        <input type="radio" name="gender" value="3" {{ (old('gender', $contact['gender'] ?? '') == 3) ? 'checked' : '' }}> その他
                    </div>
                </div>
                <div class="contact__alert--danger">
                    {{ $errors->first('gender') }}
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label for="email">メールアドレス <span class="note">※</span></label>
            </div>
            <div class="form__group-content">
                <input type="email" name="email" value="{{ old('email', $contact['email'] ?? '') }}" placeholder="例: test@example.com">
                <div class="contact__alert--danger">
                    {{ $errors->first('email') }}
                </div>
            </div>    
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label for="tel">電話番号 <span class="note">※</span></label>
            </div>
            <div class="form__group-content">
                <div class="tel-group">
                    <input type="text" id="tel_item1" name="tel_item1" maxlength="5" placeholder="080" value="{{ old('tel_item1', $contact['tel_item1'] ?? '') }}">
                    <span>-</span>
                    <input type="text" id="tel_item2" name="tel_item2" maxlength="5" placeholder="1234" value="{{ old('tel_item2', $contact['tel_item2'] ?? '') }}">
                    <span>-</span>
                    <input type="text" id="tel_item3" name="tel_item3" maxlength="5" placeholder="5678" value="{{ old('tel_item3', $contact['tel_item3'] ?? '') }}">
                    <input type="hidden" id="tel" name="tel">
                </div>
                <div class="contact__alert--danger">
                    @php
                        $telErrors = [$errors->first('tel_item1'),$errors->first('tel_item2'),$errors->first('tel_item3'),];

                        $priority2Error = collect($telErrors)->first(function ($error) {
                            return $error === '電話番号は5桁までの数字で入力してください';
                        });

                        $priority1Error = collect($telErrors)->first(function ($error) {
                            return $error === '電話番号を入力してください';
                        });

                        $errorMessage = $priority2Error ?? $priority1Error;
                    @endphp
                    {{ $errorMessage }}
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label   label for="address">住所 <span class="note">※</span></label>
            </div>
            <div class="form__group-content">
                <input type="text" name="address" value="{{ old('address', $contact['address'] ?? '') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
                <div class="contact__alert--danger">
                    {{ $errors->first('address') }}
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label for="building">建物名</label>
            </div>
            <div class="form__group-content">
                <input type="text" name="building" value="{{ old('building', $contact['building'] ?? '') }}" placeholder="例: 千駄ヶ谷マンション101">
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label for="inquiry-type">お問い合わせの種類 <span class="note">※</span></label>
            </div>
            <div class="form__group-content">
                <select name="inquiry-type">
                    <option value="" disabled {{ old('inquiry-type', $contact['inquiry-type'] ?? '') == '' ? 'selected' : '' }}>選択してください</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}"
                            {{ old('inquiry-type', $contact['inquiry-type'] ?? '') == $category['id'] ? 'selected' : '' }}>
                            {{ $category['content'] }}
                        </option>
                    @endforeach
                </select>
                <div class="contact__alert--danger">
                    {{ $errors->first('inquiry-type') }}
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label for="inquiry-content">お問い合わせ内容 <span class="note">※</span></label>
            </div>
            <div class="form__group-content">
                <textarea name="inquiry-content" rows="5" placeholder="お問い合わせ内容をご記載ください">{{ old('inquiry-content', $contact['inquiry-content'] ?? '') }}</textarea>
                <div class="contact__alert--danger">
                    {{ $errors->first('inquiry-content') }}
                </div>
            </div>
        </div>
        <div class="form__button">
            <button type="submit">確認画面</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const telitem1 = document.getElementById('tel_item1');
    const telitem2 = document.getElementById('tel_item2');
    const telitem3 = document.getElementById('tel_item3');
    const telHidden = document.getElementById('tel');
    
    const form = document.querySelector('form');
    form.addEventListener('submit', function () {
        telHidden.value = `${telitem1.value}-${telitem2.value}-${telitem3.value}`;
    });
});
</script>


@endsection
