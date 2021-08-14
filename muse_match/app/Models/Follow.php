<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Person;

class Follow extends Model
{
    use HasFactory;

    public function people()
    {
        return belongToMany('App\Models\Person');
    }

    public static function followCheck($id)
    {
        $session = session()->get('login_user');
        $data = self::where('followed_user_id', $id)->where('following_user_id', $session->id)->first();
        if(empty($data)) {
            return 'green';
        } else {
            return 'red';
        }
    }

    public static function followCtrl($session, $id)
    {
        $login_id = $session->id;
        $data = self::where('followed_user_id', $id)->where('following_user_id', $login_id)->first();
        if(empty($data)) {
            self::insert(['followed_user_id' => $id, 'following_user_id' => $login_id]);
            return 'red';
        } else {
            self::where('followed_user_id', $id)->where('following_user_id', $login_id)->delete();
            $a = false;
            return 'green'; 
        }
    }

    public static function followsGet($s)
    {
        $name = array();
        $session = session()->get('login_user');
        if($s == 'followeds') { //フォローしたユーザー
            $list = self::where('following_user_id', $session->id)->get();
            foreach($list as $followed) {
                $follows = Person::where('id', $followed->followed_user_id)->first();
                array_push($name, $follows->name);
                }

            return $name;

        } elseif($s == 'followings') { //フォローされているユーザー
            $list = self::where('followed_user_id', $session->id)->get();
            foreach($list as $following) {
                $follows = Person::where('id', $following->following_user_id)->first();
                array_push($name, $follows->name);
            }

            return $name;
        }
    }
}
