@extends('auth.layout')
@section('title')
    <h1 class="signup__wrapper-ttl">Sign up</h1>
@endsection


@section('form')
<form action="{{route("users.store")}}" method="post">
      @csrf
      <div class="form-floating mb-3" >
            <input type="text" class="form-control" id="floatingInput" name="name" value="{{old("name")}}">
            <label for="floatingInput">username</label>
            </div>
      <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password">
            <label for="floatingPassword">Password</label>
      </div> 
      <div style="padding-top: 10px"><a href="{{route("login")}}">login</a></div>
      <button type="submit" class="signup__wrapper-btn">Create →</button>
      <div class="border_bottom"></div>
</form>
@endsection