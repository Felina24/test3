<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン | PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <h1 class="title">PiGLy</h1>
            <p class="subtitle">ログイン</p>

            <form method="POST" action="{{ url('/login') }}">
                @csrf

                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" placeholder="メールアドレスを入力" value="{{ old('email') }}">
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" placeholder="パスワードを入力">
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <button type="submit">ログイン</button>
            </form>

            <a href="{{ route('register.step1') }}" class="link">アカウント作成はこちら</a>
        </div>
    </div>
</body>
</html>
