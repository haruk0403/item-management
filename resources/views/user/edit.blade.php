<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー情報編集</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
@include('includes.header')
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
</body>