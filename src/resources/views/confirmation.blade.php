@extends('layouts.app')

@section('title')
<title>お問い合わせフォーム確認ページ</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirmation.css') }}">
@endsection

@section('button')
@endsection

@section('content-title')
<p class="content-title">Confirm</p>
@endsection

@section('content')
<div class="confirmation__content">
    <form class="form" action="/thanks" method="post">
    @csrf
        <table class="confirm-table">
            <tr>
                <th>お名前</th>
                <td>{{ $contact['first_name'] }} {{ $contact['last_name'] }}</td>
            </tr>
            <tr>
                <th>性別</th>
                <td>{{ $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : 'その他') }}</td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>{{ $contact['email'] }}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{ $contact['tel'] }}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{ $contact['address'] }}</td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>{{ $contact['building'] }}</td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td>{{ $contact['inquiry_type_content'] }}</td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>{{ $contact['inquiry-content'] }}</td>
            </tr>
        </table>
        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
        <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
        <input type="hidden" name="email" value="{{ $contact['email'] }}">
        <input type="hidden" name="tel" value="{{ $contact['tel'] }}">
        <input type="hidden" name="address" value="{{ $contact['address'] }}">
        <input type="hidden" name="building" value="{{ $contact['building'] }}">
        <input type="hidden" name="detail" value="{{ $contact['inquiry-content'] }}">
        <input type="hidden" name="category_id" id="hidden-category-id" value="{{ $contact['inquiry-type'] }}">
        <div class="button-group">
            <button type="submit" class="submit-button">送信</button>
            <button type="button" class="edit-button" onclick="goBack()">修正</button>
        </div>
    </form>
</div>

<script>
    function goBack() {
        window.location.href = '/';
    }
</script>
@endsection


