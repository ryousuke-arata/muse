<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Person;

class Post extends Model
{
    use HasFactory;

    protected $guarded = array(
        'id',
        'image',
    );

    public function person()
    {
        return $this->belongTo(Person::class);
    }

    //////////////新規投稿//////////////////
    public static function newPost($request)
    {
        $person = session()->get('login_user');
        $param = [
            'person_id' => $person->id,
            
            'person_name' => $person->name,
            'title' => $request->title,
            'parts' => $request->parts,
            'content' => $request->content, 
        ];
        $id = self::insertGetId($param);
        $data = self::where('id', $id)->first();
        return $data;
    }
    //////////////////////////////////////

     //////////////投稿内容表示//////////////////
    public static function singlePostGet($id)
    {
        $post = self::where('id', $id)->first();
        return $post;
    }

    public static function singlePostMessages($id)
    {
        $messages = DB::table('messages')->where('source_message_id', $id)->get();
        return $messages;
    }
    ////////////////////////////////////////////
    
     //////////////投稿からのユーザー情報表示//////////////////
    public static function userPageGet($person_id)
    {
        $user = Person::where('id', $person_id)->first();
        return $user;
    }

    public static function userPostsGet($person_id)
    {
        $posts = self::where('person_id', $person_id)->get();
        return $posts;
    }
    //////////////////////////////////////////////////////

     //////////////投稿にメッセージを送信//////////////////
    public static function messageSend($request, $id_1, $id_2)
    {
        $session = session()->get('login_user');
        $post = self::where('id', $id_1)->first();
        
        $param = [
            'receive_user_id' => $id_2,
            'send_user_id' => $session->id,
            'send_user_name' => $session->name,
            'message' => $request->message,
            'source_title' => $post->title,
            'source_post_id' => $post->id,
        ];

        $message_id = DB::table('messages')->insertGetId($param);

        $message = DB::table('messages')->where('id', $message_id)->first();

        return $message;
    }

    public static function receiveMessages($post_id)
    {
        $messages = DB::table('messages')->where('source_post_id', $post_id)->get();
        return $messages;
    }

    public static function replyMessage($request, $post_id, $message_id)
    {
        $session = session()->get('login_user');
        $source_message = DB::table('messages')->where('id', $message_id)->first(); 
        $param = [
            'receive_user_id' => $source_message->send_user_id,
            'send_user_id' => $source_message->receive_user_id,
            'send_user_name' => $session->name,
            'message' => $request->message,
            'source_title' => $source_message->source_title,
            'source_post_id' => $post_id,
            'source_message_id' => $message_id,
        ];

        $id = DB::table('messages')->insertGetId($param);
        $message = DB::table('messages')->where('id', $id)->first();

        return $message;
    }
    ///////////////////////////////////////////////////////
}
