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
            'venue' => $request->venue,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'content' => $request->content,
        ];
        $id = self::insertGetId($param);
        $data = self::where('id', $id)->first();
        DB::table('favs')->insert(['person_id' => $person->id, 'post_id' => $id, 'fav_count' => 0]);
        return $data;
    }
    //////////////////////////////////////

    public static function favUpdate($request, $id)
    {
        DB::table('favs')->where('post_id', $id)->update(['fav_count' => $request->fav_count + 1]);
        return DB::table('favs')->where('post_id', $id)->first();
    }

    public static function indexFavGet($posts)
    {
        $fav_count = [];
        foreach ($posts as $post) {
            $fav = DB::table('favs')->where('post_id', $post->id)->first();
            $fav_count[] += $fav->fav_count;
        }
        return $fav_count;
    }
    
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
}
