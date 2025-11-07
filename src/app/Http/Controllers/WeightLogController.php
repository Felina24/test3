<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightTarget;
use App\Models\WeightLog;

class WeightLogController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $target = WeightTarget::where('user_id', $user->id)->first();
        $target_weight = $target ? $target->target_weight : null;

        $latest = WeightLog::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->first();
        $latest_weight = $latest ? $latest->weight : null;

        $difference = ($target_weight && $latest_weight)
            ? $latest_weight - $target_weight
            : null;

        $query = WeightLog::where('user_id', $user->id);
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $logs = $query->orderBy('date', 'desc')->paginate(10);

        return view('weight_logs.index', compact(
            'target_weight',
            'latest_weight',
            'difference',
            'logs'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => ['required', 'date'],
            'weight' => [
                'required',
                'numeric',
                'between:0,9999.9',
                function ($attribute, $value, $fail) {
                    if (preg_match('/\.\d{2,}$/', $value)) {
                        $fail('小数は1桁までで入力してください');
                    }
                },
            ],
            'calories' => ['required', 'numeric'],
            'exercise_time' => ['required', 'string'],
            'exercise_content' => ['nullable', 'string', 'max:120'],
        ], [
            'date.required' => '日付を入力してください',
            'weight.required' => '体重を入力してください',
            'weight.numeric' => '数字で入力してください',
            'weight.between' => '4桁までの数字で入力してください（最大9999.9）',
            'calories.required' => '摂取カロリーを入力してください',
            'calories.numeric' => '数字で入力してください',
            'exercise_time.required' => '運動時間を入力してください',
            'exercise_content.max' => '120文字以内で入力してください',
        ]);

        WeightLog::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('weight_logs.index')->with('success', 'データを追加しました。');
    }

    public function edit($id)
    {
        $log = WeightLog::findOrFail($id);
        return view('weight_logs.edit', compact('log'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => ['required', 'date'],
            'weight' => [
                'required',
                'numeric',
                'between:0,9999.9',
                function ($attribute, $value, $fail) {
                    if (preg_match('/\.\d{2,}$/', $value)) {
                        $fail('小数は1桁までで入力してください');
                    }
                },
            ],
            'calories' => ['required', 'numeric'],
            'exercise_time' => ['required', 'string'],
            'exercise_content' => ['nullable', 'string', 'max:120'],
        ], [
            'date.required' => '日付を入力してください',
            'weight.required' => '体重を入力してください',
            'weight.numeric' => '数字で入力してください',
            'weight.between' => '4桁までの数字で入力してください（最大9999.9）',
            'calories.required' => '摂取カロリーを入力してください',
            'calories.numeric' => '数字で入力してください',
            'exercise_time.required' => '運動時間を入力してください',
            'exercise_content.max' => '120文字以内で入力してください',
        ]);

        $log = WeightLog::findOrFail($id);

        $log->update([
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('weight_logs.index')->with('success', 'データを更新しました。');
    }

    public function destroy($id)
    {
        $log = WeightLog::findOrFail($id);

        if ($log->user_id !== Auth::id()) {
            abort(403, '権限がありません。');
        }

        $log->delete();

        return redirect()->route('weight_logs.index')->with('success', 'データを削除しました。');
    }

}
