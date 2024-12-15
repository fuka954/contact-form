@extends('layouts.app')

@section('title')
<title>ユーザ登録ページ</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('button')
 <a href="/login" class="header-button">login</a>
@endsection

@section('content-title')
<p class="content-title">Register</p>
@endsection

@section('content')
<div class="register__content">
    <form class="register-form" action="/register" method="post">
    @csrf
        <div class="register-form__input">
            <div class="form__group">
                <div class="form__group-title">
                    <label class="form__label">お名前</label>
                </div>
                <div class="form__group-content">
                    <input class="form__text" type="name" name="name" placeholder="例: 山田　太郎">
                </div>
                <div class="register__alert--danger {{ $errors->has('name') ? 'active' : '' }}">
                    {{ $errors->first('name') }}
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label class="form__label">メールアドレス</label>
                </div>
                <div class="form__group-content">
                    <input class="form__text" type="email" name="email" placeholder="例: test@example.com">
                </div>
                <div class="register__alert--danger {{ $errors->has('email') ? 'active' : '' }}">
                    {{ $errors->first('email') }}
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label class="form__label">パスワード</label>
                </div>
                <div class="form__group-content">
                    <input class="form__text" type="password" name="password" placeholder="例: coachtech106">
                </div>
                <div class="register__alert--danger {{ $errors->has('email') ? 'active' : '' }}">
                    {{ $errors->first('password') }}
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">登録</button>
        </div> 
    </form>
</div>
@endsection
