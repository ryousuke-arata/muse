<p>{{$message}}</p>
<form action="http://localhost:81/muse_match/public/delete" method="post">
    @csrf
  <input type="text" name='ins'>
  <input type="submit">
</form>