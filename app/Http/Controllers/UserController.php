<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\UserEditRequest;
use App\Models\User;

class UserController extends Controller
{
    //ユーザー検索機能

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $role = $request->role;
        $query = User::query();
        //キーワードがあって権限があった場合
        //キーワードがあって権限がなかった場合
        if(!empty($keyword))
            {
                if(!empty($role)){
                    $query->where('email','like','%'.$keyword.'%')->where('role','=',$role)->orWhere('name','like','%'.$keyword.'%')->where('role','=',$role);
                }else{
                    $query->where('email','like','%'.$keyword.'%')->orWhere('name','like','%'.$keyword.'%');
                }
            }
            else{
                    //キーワードがなくて権限があった場合
                     //キーワードがなくて権限がない場合
                    if(!empty($role)){
                        $query->Where('role','like','%'.$role.'%');
                    }
            }
        // 全件取得 +ページネーション
        $users = $query->orderBy('id','asc')->paginate(10);
        return view('user.index')->with('users',$users)->with('keyword',$keyword)->with('role',$role);
    }
   

    //ユーザー編集画面の表示
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    //ユーザー情報更新
    public function postEdit($id, UserEditRequest $request)
    {
        $user = User::find($id);
            
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();
    
        //ユーザー一覧へリダイレクト
        return redirect()->to('user');
    }

}

