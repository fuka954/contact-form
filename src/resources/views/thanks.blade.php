@extends('layouts.app')

@section('title')
<title>サンクスページ</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thankyou-container">
    <div class="thankyou-background">Thank you</div>
    <div class="thankyou-content">
        <p>お問い合わせありがとうございました</p>
        <a href="/" class="home-button">HOME</a>
    </div>
</div>
@endsection