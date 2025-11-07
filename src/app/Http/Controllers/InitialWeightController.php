<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WeightTarget;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InitialWeightController extends Controller
{
    public function showForm()
    {
        return view('initial_weight');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'current_weight' => ['required', 'regex:/^\d{1,4}(\.\d)?$/'],
                'goal_weight'    => ['required', 'regex:/^\d{1,4}(\.\d)?$/'],
            ],
            [
                'current_weight.required' => '現在の体重を入力してください',
                'current_weight.regex'    => '4桁までの数字で入力してください（小数点は1桁まで）',

                'goal_weight.required' => '目標の体重を入力してください',
                'goal_weight.regex'    => '4桁までの数字で入力してください（小数点は1桁まで）',
            ]
        );

        $registerData = Session::get('register_data');

        if (!$registerData) {
            return redirect()->route('register.step1')->withErrors('セッションが切れました。最初からやり直してください。');
        }

        $user = User::create([
            'name' => $registerData['name'],
            'email' => $registerData['email'],
            'password' => $registerData['password'],
        ]);

        WeightTarget::create([
            'user_id' => $user->id,
            'target_weight' => $request->goal_weight,
        ]);

        WeightLog::create([
            'user_id' => $user->id,
            'date' => now()->format('Y-m-d'),
            'weight' => $request->current_weight,
        ]);

        Auth::login($user);
        Session::forget('register_data');

        return redirect()->route('weight_logs.index');
    }
}
