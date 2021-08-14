<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Follow;
use App\Models\Post;

class FollowController extends Controller
{
    public function followCtrl(Request $request, $person_id)
    {
        $url = $request->url();
        $session = session()->get('login_user');
        $color = Follow::followCtrl($session, $person_id);
        $user = Post::userPageGet($person_id);
        $posts = Post::userPostsGet($person_id);
        return view('user.user-top', ['session' => $user, 'posts' => $posts, 'url' => $url, 'color' => $color]);
    }

    public function follows(Request $request, $follow)
    {
        $url =$request->url();
        $session = session()->get('login_user');
        $names = Follow::followsGet($follow); 
        return view('layouts.follower', ['url' => $url, 'names' => $names]);
    }
    //
}
