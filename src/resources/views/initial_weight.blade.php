<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>初期体重登録 | PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/initial_weight.css') }}">
</head>
<body>
    <div class="weight-container">
        <div class="weight-card">
            <h1 class="title">PiGLy</h1>
            <p class="subtitle">初期体重登録</p>
            <p class="step">STEP2 体重データの入力</p>

            <form method="POST" action="{{ route('register.step2') }}">
                @csrf

                <label for="current_weight">現在の体重（kg）</label>
                <input id="current_weight" type="text" name="current_weight" value="{{ old('current_weight') }}" placeholder="現在の体重を入力">
                @error('current_weight')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <label for="goal_weight">目標の体重（kg）</label>
                <input id="goal_weight" type="text" name="goal_weight" value="{{ old('goal_weight') }}" placeholder="目標の体重を入力">
                @error('goal_weight')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <button type="submit">アカウント作成</button>
            </form>

        </div>
    </div>
</body>
</html>
