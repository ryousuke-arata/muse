@extends('layouts.text-editor')

@section('header')
    @parent
@endsection

@section('content')
    @parent
    @section('action', $url . '-new')
    @section('form')
        <tr>
            <td>
                <textarea name="message" id="" cols="30" rows="10"></textarea>
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="送信"></td>
        </tr>
    @endsection
@endsection