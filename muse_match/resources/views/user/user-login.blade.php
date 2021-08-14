@extends('layouts.users')

@section('header')
  @include('components.user-header', ['link' => 'http://localhost:81/muse_match/public/new', 'text' => '新規登録'])
@endsection

@section('form')
    @parent
    @section('btn', 'ログイン')
@endsection

@section('footer')
   @parent
@endsection