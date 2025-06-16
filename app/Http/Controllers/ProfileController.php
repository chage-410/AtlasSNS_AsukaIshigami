<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->latest()->get();
        $authUser = Auth::user();
        $followingCount = $authUser->followings()->count();
        $followerCount = $authUser->followers()->count();

        // フォローしているか判定
        $isFollowing = $authUser->followings()->where('followed_id', $user->id)->exists();

        return view('profiles.show', compact('user', 'posts', 'isFollowing', 'followingCount', 'followerCount'));
    }

    public function profile()
    {
        $user = Auth::user();
        $followingCount = $user->followings()->count();
        $followerCount = $user->followers()->count();

        return view('profiles.profile', compact('user', 'followingCount', 'followerCount'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // バリデーション
        $validated = $request->validate([
            'username' => 'required|min:2|max:12',
            'email' => [
                'required',
                'min:5',
                'max:40',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => 'required|nullable|confirmed|alpha_num',
            'bio' => 'max:150',
            'images' => 'nullable|image|max:2048',
        ]);

        // 値の更新
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->bio = $validated['bio'] ?? null;

        // パスワードが入力されていた場合のみ更新
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        // アイコン画像アップロード処理
        if ($request->hasFile('images')) {

            // 新しい画像を保存
            $filename = uniqid() . '.' . $request->file('images')->getClientOriginalExtension();
            $request->file('images')->storeAs('public/icons', $filename);
            $user->icon_image = $filename;
        }

        // 保存
        $user->save();

        // リダイレクト
        return redirect()->route('top')->with('status', 'プロフィールを更新しました。');
    }
}
