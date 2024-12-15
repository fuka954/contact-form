@extends('layouts.app')

@section('title')
<title>ログインページ</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('button')
 <a href="/register" class="header-button">register</a>
@endsection

@section('content-title')
<p class="content-title">Login</p>
@endsection

@section('content')
<div class="login__content">
    <form class="login-form"  action="/login" method="post">
    @csrf
        <div class="login-form__input">
            <div class="form__group">
                <div class="form__group-title">
                    <label class="form__label">メールアドレス</label>
                </div>
                <div class="form__group-content">
                    <input class="form__text" type="email" name="email" placeholder="例: test@example.com">
                </div>
                <div class="login__alert--danger {{ $errors->has('email') ? 'active' : '' }}">
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
                <div class="login__alert--danger {{ $errors->has('password') ? 'active' : '' }}">
                    {{ $errors->first('password') }}
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">ログイン</button>
        </div>              
    </form>
</div>
@endsection