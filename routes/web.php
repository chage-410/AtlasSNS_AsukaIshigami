<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

  // トップ画面
  Route::get('/top', [PostsController::class, 'index'])->name('top');
  Route::post('top', [PostsController::class, 'post'])->name('top');
  Route::get('/top/{post}', [PostsController::class, 'update'])->name('posts.update');
  Route::put('/top/{id}/update', [PostsController::class, 'update'])->name('post.update');
  Route::delete('/top/{id}/delete', [PostsController::class, 'destroy'])->name('post.delete');

  // ユーザープロフィール
  Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.show');
  Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.edit');
  // 他ユーザーのプロフィール
  Route::get('/user/{id}', [ProfileController::class, 'show'])->name('user.profile');

  // 検索
  Route::get('search', [UsersController::class, 'search'])->name('user.search');

  // フォロー・フォロワーリスト
  Route::get('follow-list', [PostsController::class, 'followList'])->name('follow.list');
  Route::get('follower-list', [PostsController::class, 'followerList'])->name('follower.list');

  // フォローする・フォロー解除
  Route::post('/follow/{id}', [FollowsController::class, 'follow'])->name('follow');
  Route::delete('/unfollow/{id}', [FollowsController::class, 'unfollow'])->name('unfollow');

  // ログアウト
  Route::get('logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');
});
