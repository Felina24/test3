@extends('layouts.app')

@section('title', 'Weight Log 編集')

@section('content')
<div class="page-form">

    <form method="POST" action="{{ route('weight_logs.update', $log->id) }}" class="modal-form">
        @csrf

        <h2>Weight Log</h2>

        <label>日付</label>
        <input type="date" name="date" value="{{ old('date', $log->date) }}">
        @error('date') <p class="error">{{ $message }}</p> @enderror

        <label>体重</label>
        <div class="input-with-unit">
            <input type="text" name="weight" value="{{ old('weight', $log->weight) }}">
            <span class="unit">kg</span>
        </div>
        @error('weight') <p class="error">{{ $message }}</p> @enderror

        <label>摂取カロリー</label>
        <div class="input-with-unit">
            <input type="text" name="calories" value="{{ old('calories', $log->calories) }}">
            <span class="unit">cal</span>
        </div>
        @error('calories') <p class="error">{{ $message }}</p> @enderror

        <label>運動時間</label>
        <input type="text" name="exercise_time" value="{{ old('exercise_time', $log->exercise_time) }}">
        @error('exercise_time') <p class="error">{{ $message }}</p> @enderror

        <label>運動内容</label>
        <textarea name="exercise_content">{{ old('exercise_content', $log->exercise_content) }}</textarea>
        @error('exercise_content') <p class="error">{{ $message }}</p> @enderror

        <div class="modal-buttons">
            <div class="center-buttons">
                <a href="{{ route('weight_logs.index') }}" class="btn-secondary">戻る</a>
                <button type="submit" class="btn-primary">更新</button>
            </div>
        </div>
    </form>

    <div class="delete-area">
        <form method="POST"
              action="{{ route('weight_logs.destroy', $log->id) }}"
              onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete delete-red">🗑</button>
        </form>
    </div>

</div>
@endsection
