@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>ユーザー一覧</h1>
@stop

@section('content')
      <!-- Page Content -->
      <div class="card">
        <div class="row justify-content-center">
          <div class="col-12">
          <div class="card-header">
        <!-- 検索フォーム -->
        <form method="get" action="/user" class="form-inline">
            <div class="form-group">
                <input type="text" name="keyword" class="form-control-sm"  placeholder="検索キーワード" value="{{$keyword}}">
            </div>
        
            <div class="form-check form-check-inline">
             <input class="form-check-input" type="radio" name="role" value="2" {{$role ==2 ? "checked" : ""}}>
             <label class="form-check-label">管理者</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="role" value="1" {{$role ==1 ? "checked" : ""}}>
              <label class="form-check-label">利用者</label>
            </div> 
            <div>
            <input type="submit" value="検索" class="btn btn-outline-success">
            </div>
            </form>
         </div>
        </div>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>名前</th>
                <th>e-mailアドレス</th>
                <th>権限</th>
                <th>更新日時</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
               <td>{{ $user->id }}</td>
               <td>{{ $user->name }}</td>
               <td>{{ $user->email }}</td>
                <td>@if($user->role ==2)管理者
                 @else 利用者
                @endif
               </td>
                <td>{{ $user->updated_at }}</td>
                <td><a href="{{ route('user.edit', ['id'=>$user]) }}" class="btn btn btn-outline-primary">>>編集</a></td>
              </tr>
              @endforeach
          </table>
          <div class="pagination justify-content-center">
          {{ $users->appends(request()->query())->Links('pagination::bootstrap-4') }}
          </div>
        </div>
  </div>
  @stop

@section('css')
@stop

@section('js')
@stop