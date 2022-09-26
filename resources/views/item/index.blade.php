@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <!-- 検索機能ここから -->
                    <div>
                         <form action="/items/search" method="get" value="">
                            <input type="text" class="form-control-sm" placeholder="商品名を入力" name="keyword" value="">
                             <input type="submit" class="btn btn-success" value="検索">
                         </form>
                     </div>
                         <!-- 検索機能ここまで -->
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                <table class="table table-striped">                        
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>カテゴリ</th>
                                <th>詳細</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->detail }}</td>
                                    <td><a href="{{ route('item.edit', ['id'=>$item]) }}" class="btn btn btn-outline-primary">>>編集</a></td>
                                    @if($user->role == 2)
                                    <td><form action="{{ route('item.destroy', ['id'=>$item->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">削除</button></form></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
