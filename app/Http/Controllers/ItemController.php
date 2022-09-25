<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Http\Requests\ItemEditRequest;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item
            ::where('items.status', 'active')
            ->select()
            ->get();

        return view('item.index', compact('items'));
    }
    /**
     * 商品検索
     */
    public function item(Request $request)
    {
        $message = null;
        $item = [];

        if (isset($request->keyword )) {
            $item = Item::where('name', 'like', '%' . $request->keyword . '%')->orderBy('id','asc')->paginate(10);
            if(count($item)==0){
                $message = "検索結果はありません。";
            }
        }
        else {
            $item = Item::orderBy('id','asc')->paginate(10);
        }
        return view('item.search')->with([
            'item' => $item,
            'message'=>$message
        ]);
    }

    /**
        * 商品削除
        *
        */
        public function destroy($id)
        {
            // Itemsテーブルから指定のIDのレコード1件を取得
            $item = Item::find($id);
            // レコードを削除
            $item->delete();
            // 削除したら一覧画面にリダイレクト
            return redirect('/items');
        }

    /**
     * 商品登録
     */
    public function register()
    {
        $type = item::TYPE;
        return view('item.add', compact('type'));
    }
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);
            return redirect('/items');
        }
            $type = item::TYPE;
            return view('item.add',compact('type'));
    }

     //商品編集画面の表示
     public function edit($id)
     {
         $item = Item::find($id);
         $type = item::TYPE;
         return view('item.edit', compact('type'))->with([
             'item' => $item,
            ]);
     }
 
     //商品情報更新
     public function postEdit($id, ItemEditRequest $request)
     {
        $item = Item::find($request->id);
        $item->name = $request->name;
        $item->type = $request->type;
        $item->detail = $request->detail;
        $item->save();
         //商品一覧へリダイレクト
         return redirect()->to('items');
     }
}
