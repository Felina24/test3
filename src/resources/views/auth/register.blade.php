<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy 新規会員登録</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <h1 class="title">PiGLy</h1>
            <p class="subtitle">新規会員登録</p>
            <p class="step">STEP1 アカウント情報の登録</p>

            <form method="POST" action="{{ route('register.step1') }}">
                @csrf

                <label for="name">お名前</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="名前を入力">
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <label for="email">メールアドレス</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレスを入力">
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <label for="password">パスワード</label>
                <input id="password" type="password" name="password" placeholder="パスワードを入力">
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <button type="submit">次に進む</button>
            </form>

            <a href="{{ url('/login') }}" class="login-link">ログインはこちら</a>
        </div>
    </div>
</body>
</html>
