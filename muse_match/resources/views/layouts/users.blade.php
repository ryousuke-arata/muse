<!DOCTYPE html>
<html lang="ja">
<head>
    @include('components.head')
</head>
<body>
    @yield('header')

    @section('form')
      <main>
        <div class="form-area">
          <form action="http://localhost:81/muse_match/public/login-top" method="post">
            @csrf
            <table>
              @if (count($errors))
                  @foreach ($errors->all() as $error)
                      <tr>
                        <td>{{$error}}</td>
                      </tr>
                  @endforeach
              @endif
              
              <tr>
                <th>メールアドレス: </th>
                <td><input id="email-form" type="text" name="mail" value="{{old('mail')}}"></td>
              </tr>
        
              <tr>
                <th>パスワード: </th>
                <td><input id="pass-form" type="text" name="pass" value="{{old('pass')}}"></td>
              </tr>
              <tr>
                <th></th>
                <td><input type="submit" class="btn" value="@yield('btn')" name="add"></td>
              </tr>
            </table>
          </form>
        </div>
      </main>
    @show

    @section('footer')
        @include('components.user-footer')
    @show
</body>
</html>