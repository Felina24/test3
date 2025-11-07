<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // ログイン画面のビューを指定
        Fortify::loginView(function () {
            return view('auth.login'); // resources/views/auth/login.blade.php
        });

        // 会員登録画面のビューを指定
        Fortify::registerView(function () {
            return view('auth.register'); // resources/views/auth/register.blade.php
        });

        // ログイン処理のカスタマイズ（デフォルト認証）
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            return null;
        });

        // ログイン後のリダイレクト先
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                return redirect()->intended('/weight_logs');
            }
        });
    }
}
