<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //ポスト表示用
    public function index()
    {
        $user = auth()->user();
        $followedUserIds = auth()->user()->followings->pluck('id');
        // 自分のIDも追加
        $followedUserIds->push(auth()->id());
        $posts = Post::with('user')
            ->whereIn('user_id', $followedUserIds)
            ->latest()
            ->get();

        $followingCount = $user->followings()->count();
        $followerCount = $user->followers()->count();
        return view('posts.index', compact('posts', 'followingCount', 'followerCount', 'user'));
    }

    // ポスト投稿用
    public function post(Request $request)
    {
        $validator = $request->validate([ // バリデーション
            'post' => ['required', 'min:1', 'max:150'], // 入力必須・1文字以上,150文字以内
        ]);
        Post::create([ // Postテーブルに入れる
            'user_id' => Auth::user()->id, // Auth::user()は、現在ログインしている人（つまりツイートしたユーザー）
            'post' => $request->post, // ツイート内容
        ]);
        return back(); // リクエスト送ったページに戻る（リダイレクトする）
    }

    // ポスト編集用
    public function update(Request $request, $id)
    {
        $request->validate([
            'post' => 'required|string|max:150',
        ]);

        $post = Post::findOrFail($id);

        // 認可チェック（本人の投稿のみ削除許可）
        if ($post->user_id !== auth()->id()) {
            abort(403, 'この投稿は本人のみ編集することができます。');
        }

        $post->post = $request->input('post');
        $post->save();

        return redirect('/top')->with('success', '投稿を更新しました。');
    }

    // 削除用
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // 認可チェック（本人の投稿のみ削除許可）
        if ($post->user_id !== auth()->id()) {
            abort(403, 'この投稿は本人のみ削除することができます。');
        }

        $post->delete();

        return redirect('/top')->with('status', '投稿を削除しました');
    }


    // フォローリスト用
    public function followList()
    {
        $user = Auth::user();
        // フォローしているユーザーの投稿を取得（新しい順）
        $posts = \App\Models\Post::whereIn('user_id', $user->followings->pluck('id'))
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        // フォローしているユーザー一覧（アイコン用）
        $followings = $user->followings;

        // フォロー数、フォロワー数
        $followingCount = $user->followings->count();
        $followerCount = $user->followers->count();

        return view('follows.followList', compact('user', 'posts', 'followings', 'followingCount', 'followerCount'));
    }

    // フォロワーリスト用
    public function followerList()
    {
        $user = Auth::user();
        // フォロワーのユーザーの投稿を取得（新しい順）
        $posts = \App\Models\Post::whereIn('user_id', $user->followers->pluck('id'))
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        // フォロワーのユーザー一覧（アイコン用）
        $followers = $user->followers;

        // フォロー数、フォロワー数
        $followingCount = $user->followings->count();
        $followerCount = $user->followers->count();

        return view('follows.followerList', compact('user', 'posts', 'followers', 'followingCount', 'followerCount'));
    }

    // フォロー数
    public function followCounts()
    {
        $follows = Follow::where(‘id’, Auth::id())->get();
        return view('layouts.login', compact('ids'));
    }
}
