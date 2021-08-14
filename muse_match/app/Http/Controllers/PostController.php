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


    public function post_new(Request $request)
    {
        $url = $request->url();
        return view('post.post-new', ['url' => $url]);
    }

    public function post_new_post(Request $request)
    {
        $post = Post::newPost($request);
        return view('post.post-single', ['post' => $post]);
    }

    public function single_post(Request $request, $id)
    {
        $url = $request->url();
        $post = Post::singlePostGet($id);
        $messages = Post::singlePostMessages($id);
        return view('post.post-single', ['url' => $url, 'post' => $post, 'messages' => $messages]);
    }

    public function user_page(Request $request, $person_id)
    {
        $session = session()->get('login_user');
        $url = $request->url();
        $user = Post::userPageGet($person_id);
        $posts = Post::userPostsGet($person_id);
        $color = Follow::followCheck($person_id);
        return view('user.user-top', ['session' => $user, 'posts' => $posts, 'url' => $url, 'color' => $color]);
    }

    public function message_create(Request $request, $person_id, $id)
    {
        $url = $request->url();
        return view('post.message-create', ['url' => $url, 'person_id' => $person_id, 'id' => $id]);
    }

    public function message_create_post(Request $request, $person_id, $id)
    {
        $url = $request->url();
        $message = Post::messageSend($request, $id, $person_id);
        return view('post.message-conf', ['url' => $url, 'message' => $message, 'replay_message' => '']);
    }

    public function receive_messages(Request $request, $id)
    {
        $url = $request->url();
        $messages = Post::receiveMessages($id);
        return view('post.message-receive', ['url' => $url, 'messages' => $messages]); 
    }

    public function reply_message_post(Request $request, $post_id, $message_id)
    {
        $url = $request->url();
        $messages = Post::receiveMessages($post_id);
        $reply_message = Post::replyMessage($request, $post_id, $message_id);
        return view('post.message-receive', ['url' => $url, 'messages' => $messages, 'reply_message' => $reply_message]);
    }

    public function test() {
        $items = Post::all();
        return view('test.test', ['items' => $items]);
    }
    //
}
