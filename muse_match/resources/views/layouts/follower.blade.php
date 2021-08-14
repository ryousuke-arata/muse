<!DOCTYPE html>
<html lang="ja">
<head>
   @include('components.head')
</head>
<body>
    @section('header')
      @include('components.user-header')
    @show
    
    @section('content')
    <div class="follow-list">
        <table>
          @foreach($names as $name)
            <tr>
                <td>{{$name}}</td>
            </tr>
          @endforeach
        </table>
    </div>
    @show
</body>
</html>