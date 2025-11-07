@extends('layouts.app')

@section('title', '目標体重設定')

@section('content')
<div class="page-form">
    <form method="POST" action="{{ route('target.update') }}" class="modal-form">
        @csrf
        <h2>目標体重を設定</h2>

        <label>目標体重</label>
        <div class="input-with-unit">
            <input type="text" name="target_weight" value="{{ old('target_weight', $target->target_weight ?? '') }}">
            <span class="unit">kg</span>
        </div>
        @error('target_weight') <p class="error">{{ $message }}</p> @enderror

        <div class="center-buttons">
            <a href="{{ route('weight_logs.index') }}" class="btn-secondary">戻る</a>
            <button type="submit" class="btn-primary">更新</button>
        </div>
    </form>
</div>
@endsection