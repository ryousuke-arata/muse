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
     <div class="form-area">
      <form action="@yield('action')" method="post">
        @csrf
          <table>
              @yield('form')
          </table>
      </form>
     </div>
    @show

    @section('footer')
        @component('components.user-footer')
    @show
</body>
</html>