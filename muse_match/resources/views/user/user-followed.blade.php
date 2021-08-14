@extends('name')

@section('header')
    @include('components.user-header')
@endsection

@section('content')
    <table>
        @foreach ($follows as $followed)
            <td>{{$folllowed->followed_user_id}}</td>
        @endforeach
    </table>    
@endsection