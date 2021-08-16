@extends('layouts.text-editor')

@section('header')
    @parent
@endsection

@section('content')
    @parent
    @section('form')
        @section('action', 'http://localhost:81/muse_match/public/pr-update-top')
        <tr>
            <th>自己PR</th>
            <td><textarea name="pr" id="pr" cols="30" rows="10">
                @isset($session->pr)
                  {{$session->pr}}
                @endisset
                </textarea>
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="add" value="送信"></td>
        </tr>
    @endsection
@endsection

@section('footer')
    @parent
@endsection