<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    @yield('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&family=Noto+Serif+JP:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>

<body>
    @if (View::hasSection('button'))
    <header class="header">
        <div class="header__inner">
            <p class="header-title">FashionablyLate</p>
            @yield('button')
        </div>
    </header>
    @endif
    <main>
        @if (View::hasSection('content-title'))
        <div class="content__heading">
            @yield('content-title')
        </div>
        @endif
        @yield('content')
    </main>
</body>
</html>