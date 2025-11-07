@extends('layouts.app')

@section('title', '体重管理')

@section('content')
<div class="stats-box">
    <div class="stat-item">
        <p>目標体重</p>
        <h2>{{ $target_weight ?? '--' }}kg</h2>
    </div>
    <div class="divider"></div>
    <div class="stat-item">
        <p>目標まで</p>
        <h2>{{ $difference ? number_format($difference, 1) : '--' }}kg</h2>
    </div>
    <div class="divider"></div>
    <div class="stat-item">
        <p>最新体重</p>
        <h2>{{ $latest_weight ?? '--' }}kg</h2>
    </div>
</div>

<div class="filter-container">
    <form method="GET" action="{{ route('weight_logs.index') }}" class="filter-form">
        <input type="date" name="start_date" value="{{ request('start_date') }}">
        <input type="date" name="end_date" value="{{ request('end_date') }}">
        <button type="submit" class="btn-primary">検索</button>
    </form>

    <button id="addDataBtn" class="btn-add">データ追加</button>
</div>

<table class="log-table">
    <thead>
        <tr>
            <th>日付</th>
            <th>体重</th>
            <th>摂取カロリー</th>
            <th>運動時間</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ $log->date }}</td>
            <td>{{ $log->weight }}kg</td>
            <td>{{ $log->calories }}cal</td>
            <td>{{ $log->exercise_time }}</td>
            <td><a href="{{ route('weight_logs.edit', $log->id) }}">✏️</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination">
    @if ($logs->hasPages())
        {{ $logs->links() }}
    @else
        <div class="simple-pagination">
            <span class="active">1</span>
        </div>
    @endif
</div>

<div id="modal" class="modal hidden">
    <form method="POST" action="{{ route('weight_logs.store') }}" class="modal-form" novalidate>
        @csrf
        <h2>Weight Logを追加</h2>

        <label>日付 <span class="required">必須</span></label>
        <input type="date" name="date" value="{{ old('date') }}" required>
        @error('date') <p class="error">{{ $message }}</p> @enderror

        <label>体重 <span class="required">必須</span></label>
        <div class="input-with-unit">
            <input type="text" name="weight" value="{{ old('weight') }}" required placeholder="50.0">
            <span class="unit">kg</span>
        </div>
        @error('weight') <p class="error">{{ $message }}</p> @enderror

        <label>摂取カロリー <span class="required">必須</span></label>
        <div class="input-with-unit">
            <input type="text" name="calories" value="{{ old('calories') }}" required placeholder="1200">
            <span class="unit">cal</span>
        </div>
        @error('calories') <p class="error">{{ $message }}</p> @enderror

        <label>運動時間 <span class="required">必須</span></label>
        <input type="text" name="exercise_time" value="{{ old('exercise_time') }}" required placeholder="00:00">
        @error('exercise_time') <p class="error">{{ $message }}</p> @enderror

        <label>運動内容</label>
        <textarea name="exercise_content" placeholder="運動内容を追加">{{ old('exercise_content') }}</textarea>
        @error('exercise_content') <p class="error">{{ $message }}</p> @enderror

        <div class="center-buttons">
            <button type="button" id="closeModal" class="btn-secondary">戻る</button>
            <button type="submit" class="btn-primary">登録</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const modal = document.getElementById('modal');
    const openBtn = document.getElementById('addDataBtn');
    const closeBtn = document.getElementById('closeModal');

    openBtn.addEventListener('click', () => modal.classList.remove('hidden'));
    closeBtn.addEventListener('click', () => modal.classList.add('hidden'));

    @if ($errors->any())
        window.addEventListener('DOMContentLoaded', () => modal.classList.remove('hidden'));
    @endif
</script>
@endsection