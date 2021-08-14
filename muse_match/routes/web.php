<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

$userNamespace = 'App\Http\Controllers\UserController@';
$postNamespace = 'App\Http\Controllers\PostController@';
$followNamespace = 'App\Http\Controllers\FollowController@';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('posts', $postNamespace . 'index');

Route::get('user-top', $userNamespace . 'user_top');

Route::get('new', $userNamespace . 'user_new');

//Route::post('new-login', $userNamespace . 'user_create');

Route::post('new-top', $userNamespace . 'user_new_post');

Route::get('login', $userNamespace . 'user_login');

Route::post('login-top', $userNamespace . 'user_login_post');

Route::get('pr-update', $userNamespace . 'pr_update');

Route::post('pr-update-top', $userNamespace . 'pr_update_post');

Route::get('update', $userNamespace . 'user_update');

Route::post('user-update-top', $userNamespace . 'user_update_post');

////////////////////募集文投稿/////////////////////
Route::get('post-new', $postNamespace . 'post_new');

Route::post('new-posts', $postNamespace . 'post_new_post');

Route::get('post-single-{id?}', $postNamespace . 'single_post');

Route::get('user-page/{person_id?}', $postNamespace . 'user_page');

Route::post('user-page/{person_id?}', $followNamespace . 'followCtrl');

Route::get('user-{follow?}', $followNamespace . 'follows');

Route::get('{person_id?}/post-single-{id?}/message', $postNamespace . 'message_create');

Route::post('{person_id?}/post-single-{id?}/message-new', $postNamespace . 'message_create_post');

Route::get('messages/{id?}', $postNamespace . 'receive_messages');

Route::get('post-{post_id?}/message-{message_id?}/reply', $postNamespace . 'reply_message');

Route::get('post-{{$post_id}}/reply_message-{{message_id?}}/reply"', $postNamespace . 'reply_message');

Route::post('post-{post_id?}/post-single-/{message_id?}/message-new', $postNamespace . 'reply_message_post');

Route::get('test', $postNamespace . 'test');