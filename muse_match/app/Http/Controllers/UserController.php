<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Person;

class UserController extends Controller
{
    ////////ユーザー登録
    public function user_new(Request $request)
    {
        $url = $request->url();
        return view('user.user-new', ['url' => $url]);
    }

    public function user_new_post(Request $request)
    {
        $url = $request->url();
        $person = new Person;
        Person::createSave($request, $person);
        $session = session()->get('login_user');
        return view('user.user-top', ['session' => $session, 'posts' => '', 'url' => $url, 'fav_counts' => 0]);
    }
    ///////////////////////////

    //////////////////ログイン
    public function user_login(Request $request) 
    {
        $url = $request->url();
        return view('user.user-login', ['url' => $url]);
    }

    public function user_login_post(Request $request)
    {
        $url = $request->url();
        $data = Person::loginUser($request);
        $session = session()->get('login_user');
        $posts = $data->posts;
        $fav_counts = Person::loginFavCount($request);
        return view('user.user-top', ['session' => $session, 'posts' => $posts, 'url' => $url, 'fav_counts' => $fav_counts]);
    }
    //////////////////

    ////////////経歴・自己PR//////////////////////////
    public function pr_update(Request $request)
    {
        $session = session()->get('login_user');
        $next = Person::sessionCheck('user.pr', $request, $session, null);
        return $next;
    }

    public function pr_update_post(Request $request)
    {
        Person::dataUpdate($request);
        $session = session()->get('login_user');
        $postSession = session()->get('user_posts');
        $next = Person::sessionCheck('user.user-top', $request, $session, $postSession);
        return $next;
    }
    ///////////////////////

    ////////////ユーザー情報更新
    public function user_update(Request $request)
    {
        $session = session()->get('login_user');
        $next = Person::sessionCheck('user.user-update', $request, $session, null);
        return $next;
    }

    public function user_update_post(Request $request)
    {
        Person::dataUpdate($request);
        $session = session()->get('login_user');
        $postSession = session()->get('user_posts');
        $next = Person::sessionCheck('user.user-top', $request, $session, $postSession);
        return $next;
    }
    ////////////

    public function user_top(Request $request)
    {
        $session = session()->get('login_user');
        $data = Person::with('posts')->where('id', $session->id)->where('mail', $session->mail)->first();
        $posts = $data->posts;
        $next = Person::sessionCheck('user.user-top', $request, $session, $posts);

        return $next;
    }
    
}
