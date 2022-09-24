@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
<div class="container">
        <h2 class="fs-1 mt-5 mb-5 text-center">検索結果</h2>
        <!-- 検索機能ここから -->
        <a href="/items">>>戻る</a>
        @if(isset($item))
        <table class="table">
            <thead>
                <tr>
                    <th>商品id</th>
                    <th>商品名</th>
                    <th>カテゴリ</th>
                    <th>ステータス</th>
                    <th>更新日時</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($item as $value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->type}}</td>
                    <td>@if($value->status == 1)有効
                        @else 無効
                        @endif
                    </td>
                    <td>{{$value->updated_at}}</td>
                    <td>
                        <a href="/item/edit/{{$value->id}}" class="btn btn-primary">>>編集</a>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tr>
            </tbody>
        </table>
        @endif
        @if(isset($message))
        <div class="alert alert-danger" role="">{{ $message}}</div>
        @endif
    </div>
    @stop

@section('css')
@stop

@section('js')
@stop
