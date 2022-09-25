@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品情報編集</h1>
@stop

@section('content')
  <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card">
          <div class="mx-auto">
            <div class="card-header bg-transparent">商品情報編集</div>
              <div class="card-body">
                <form action="{{ route('items.postEdit', ['id' => $item->id]) }}" method="post">
                  @csrf
                  <p>ID: {{ $item->id }}</p>
                  <input type="hidden" name="id" value="{{ $item->id }}" />
                  <p>名前</p>
                  <input type="text" name="name" value="{{ old('name',$item->name)}}" />
                  @if ($errors->has('name'))
                  <div class="alert alert-warning s-2" role="alert"> {{ $errors->first('name')}}</div>
                  @endif
                  <p>カテゴリ<select class="form-control" id="type" name="type">
                                    @foreach($type as $t)
                                    @if($t == $item->type)
                                    <option value="{{$t}}" selected>{{$t}}</option>
                                    @else
                                    <option value="{{$t}}">{{$t}}</option>
                                    @endif
                                    @endforeach
                                </select></p>

                  @if ($errors->has('type'))
                  <div class="alert alert-warning s-2" role="alert"> {{ $errors->first('type')}} </div>
                  @endif
                  <p>詳細</p>
                  <input type="text" name="detail" value="{{ old('detail',$item->detail) }}" />
                  <div class="btn-toolbar">
                  <input class="btn btn-primary" type="submit" value="更新">
                  <a href="/items/" class="btn btn-outline-primary">商品一覧に戻る</a>
                  </div>
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