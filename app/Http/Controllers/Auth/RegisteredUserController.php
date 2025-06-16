<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        //バリデート
        $request->validate([
            'username' => ['required', 'min:2', 'max:12'],
            'email' => ['required', 'min:5', 'max:40', 'unique:users,email', 'email'],
            'password' => ['required', 'confirmed', 'alpha_num', 'min:8', 'max:20', Rules\Password::defaults()],
        ]);
        //判定入れる
        $username = $request->input('username');
        //ユーザー作成（）
        User::create([ // Userテーブルに入れる
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/added')->with('username', $username);
    }

    public function added(Request $request)
    {
        //新規登録後ユーザー名を表示させたい
        $username = $request->input('username');
        return view('auth.added', ['username' => $username]);
    }
}
