@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>ユーザー情報編集</h1>
@stop

@section('content')
  <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card">
          <div class="mx-auto">
            <div class="card-header bg-transparent">ユーザー情報編集</div>
              <div class="card-body">
                <form action="{{ route('users.postEdit', ['id' => $user->id]) }}" method="post">
                  @csrf
                  <p>ID: {{ $user->id }}</p>
                  <input type="hidden" name="id" value="{{ $user->id }}" />
                  <p>名前</p>
                  <input type="text" name="name" value="{{ old('name',$user->name)}}" />
                  @if ($errors->has('name'))
                  <div class="alert alert-warning s-2" role="alert"> {{ $errors->first('name')}}</div>
                  @endif
                  <p>メール</p>
                   <input type="text" name="email" value="{{ old('email',$user->email) }}" />
                  @if ($errors->has('email'))
                  <div class="alert alert-warning s-2" role="alert"> {{ $errors->first('email')}} </div>
                  @endif
                  <p>権限</p>
                  <input type="radio" name="role" value="2" {{ old ('role', $user->role)==2 ? "checked" : "" }} />管理者
                  <input type="radio" name="role" value="1" {{ old('role', $user->role)==1 ? "checked" : "" }}/>利用者<br />
                  <input class="btn btn-primary" type="submit" value="更新">
                  <a href="/user/" class="btn btn-outline-primary">ユーザー一覧に戻る</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>


            </div>
          </div>
          @stop

@section('css')
@stop

@section('js')
@stop