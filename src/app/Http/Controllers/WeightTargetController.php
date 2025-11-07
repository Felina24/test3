<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightTarget;

class WeightTargetController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $target = WeightTarget::where('user_id', $user->id)->first();

        return view('target.edit', compact('target'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'target_weight' => ['required', 'numeric', 'min:1', 'max:999'],
        ], [
            'target_weight.required' => '目標体重を入力してください。',
            'target_weight.numeric' => '数字で入力してください。',
        ]);

        $user = Auth::user();

        $target = WeightTarget::firstOrNew(['user_id' => $user->id]);
        $target->target_weight = $request->input('target_weight');
        $target->save();

        return redirect()->route('weight_logs.index')->with('success', '目標体重を更新しました。');
    }
}
