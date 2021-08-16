<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Follow;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $url = $request->url();
        $session = session()->get('login_user');
        $posts = Post::where('person_id', '<>', $session->id)->get();
        return view('muse.index', ['posts' => $posts, 'url' => $url]);
    }

//////////////////////募集文投稿/////////////////////////////
    public function post_new(Request $request)
    {
        $url = $request->url();
        return view('post.post-new', ['url' => $url]);
    }

    public function post_new_post(Request $request)
    {
        $url = $request->url();
        $post = Post::newPost($request);
        return view('post.post-single', ['post' => $post, 'url' => $url]);
    }
///////////////////////////////////////////////////////////

//////////////////////募集文表示/////////////////////////////
    public function single_post(Request $request, $id)
    {
        $url = $request->url();
        $post = Post::where('id', $id)->first();
        return view('post.post-single', ['url' => $url, 'post' => $post]);
    }
///////////////////////////////////////////////////////////

//////////////////////募集文表示ページからユーザーページへアクセス/////////////////////////////
    public function user_page(Request $request, $person_id)
    {
        $session = session()->get('login_user');
        $url = $request->url();
        $user = Post::userPageGet($person_id);
        $posts = Post::userPostsGet($person_id);
        return view('user.user-top', ['session' => $user, 'posts' => $posts, 'url' => $url]);
    }
///////////////////////////////////////////////////////////////////////////////
    //
}
