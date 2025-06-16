<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function search(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->input('keyword');

        $query = User::query()->where('id', '!=', $user->id); // 自分を除外

        if (!empty($keyword)) {
            $query->where('username', 'like', '%' . $keyword . '%');
        }

        $users = $query->where('id', '!=', Auth::id())->get(); // 自分自身を除外

        // ログインユーザーのフォロー数・フォロワー数を取得
        $users = $query->get();
        $followingCount = $user->followings()->count();
        $followerCount = $user->followers()->count();

        return view('users.search', compact('users', 'keyword', 'followingCount', 'followerCount'));
    }
}
