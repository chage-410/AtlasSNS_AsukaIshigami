<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FollowsController extends Controller
{
    public function follow($id)
    {
        $user = Auth::user();
        $user->followings()->attach($id);
        return back();
    }

    public function unfollow($id)
    {
        $user = Auth::user();
        $user->followings()->detach($id);
        return back();
    }
}
