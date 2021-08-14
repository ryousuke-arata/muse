<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class Person extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    protected $guarded = array( //入力必須でない項目の設定
        'career', 
        'pr',
    );
    public $incrementing = false;//プライマリキーの自動増減を停止
    public $timeStamps = false;//created_atの自動更新を停止
    public static $rules = array(//validationルールの設定
        'id' => 'required',
        'mail' => 'required|email',
        'pass' => 'required',
        'name' => 'required',
        'ins' => 'required',
    );

    public static $messages = array(//エラーメッセージの変更
        'id.required' => 'IDが未入力です',
        'mail.required' => 'メールアドレスが未入力です',
        'mail.email' => 'メールアドレスを入力してください',
        'pass.required' => 'パスワードが違います',
        'name.required' => '名前を入力してください',
        'ins.required' => '担当楽器を入力してください',
    );
 
    protected $primaryKey = 'id';//プライマリキーの指定
    protected $keyType = 'text';//プライマリキーの型指定


    public static function createSave($request, $self) 
    {
        $form = $request->all();
        unset($form['_token']);
        if(isset($request->mail)) {
            $self->timestamps = false;
        }
        $self->fill($form)->save(); 
        session()->put('login_user', $data);

    }

    public static function loginUser($request)
    {
        $form = $request->all();
        unset($form['_token']);
        $data = self::where('mail', $request->mail)->where('pass', $request->pass)->first();
        session()->put('login_user', $data);
        $data = self::with('posts')->where('mail', $request->mail)->first();

        session()->put('user_posts', $data->posts);
        return $data;
    }

    public static function dataUpdate($request) {
        $session = session()->get('login_user');

        if($request->url() == 'http://localhost:81/muse_match/public/user-update-top') {
            $userParam = [
                'id' => $request->id,
                'mail' => $request->mail,
                'name' => $request->name,
                'ins' => $request->ins,
                'pass' => $session->pass,
                'career'=> $session->career,
                'pr' => $session->pr,
            ];
            $postParam = [
                'person_id' => $request->id,
                'person_name' => $request->name,
            ];
            self::where('id', $session->id)->where('mail', $session->mail)->update($userParam);
            Post::where('person_id', $session->id)->where('person_name', $session->name)->update($postParam);
            $data = self::where('id', $request->id)->where('mail', $request->mail)->first();
        } else {
            self::where('id', $session->id)->where('mail', $session->mail)->update(['career' => $request->career, 'pr' => $request->pr]);
            $data = self::where('career', $request->career)->where('pr', $request->pr)->first();
        }
        session()->put('login_user', $data);
    }

    public static function sessionCheck($link, $request, $session, $posts)
    {
        $param = [
            'session' => $session,
            'url' => $request->url(),
            'posts' => $posts,
        ];
        if(isset($session)) {
            return view($link, $param);
        } else {
            return view('user.user-login', $param);
        }
    }

}