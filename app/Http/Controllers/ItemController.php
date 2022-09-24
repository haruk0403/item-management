<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

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
     * 商品登録
     */
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

        return view('item.add');
    }
}
