<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/weight_logs.css') }}">
</head>
<body>
<header>
    <h1 class="logo">PiGLy</h1>
    <div class="header-right">
        <a href="{{ route('target.edit') }}" class="btn-secondary">⚙️ 目標体重設定</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-secondary">⍈ ログアウト</button>
        </form>
    </div>
</header>

<main>
    @yield('content')
</main>

@yield('scripts')
</body>
</html>