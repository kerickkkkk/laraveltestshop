@extends('layouts.app')

@section('content')

<h1>登入頁面</h1>

<form action="{{route('member.session.store')}}" method="POST">
  @csrf
  <div class="form-group">
    <label for="email">email</label>
    <input type="email" name="email" id="email">
  </div>
  <div class="form-group">
    <label for="password">password</label>
    <input type="password" name="password" id="password">
  </div>
  <button>送出</button>
</form>


@endsection

@section('inline_js')
    @parent
@endsection