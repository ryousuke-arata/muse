@extends('layouts.users')

@section('header')
    @include('components.user-header')
@endsection

@section('form')
  <main>
    <div class="form-area">
      <form action="http://localhost:81/muse_match/public/user-update-top" method="post">
        @csrf
        <table>
          <tr>
            <th>ユーザーID: </th>
            <td><input id="id-form" type="text" name="id" value="{{$session->id}}"></td>
          </tr>
          <tr>
            <th>メールアドレス: </th>
            <td><input id="email-form" type="text" name="mail" value="{{$session->mail}}"></td>
          </tr>
          <tr>
              <th>名前</th>
              <td><input id="name-form" type="text" name="name" value="{{$session->name}}"></td>
          </tr>
          <tr>
              <th>楽器</th>
              <td><input id="ins-form" type="text" name="ins" value="{{$session->ins}}"></td>
          </tr>
          <tr>
            <th></th>
            <td><input type="submit" class="btn" value="登録" name="add"></td>
          </tr>
        </table>
@endsection