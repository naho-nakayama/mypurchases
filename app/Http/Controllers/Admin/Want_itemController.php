<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Want_item;
use Auth;
use App\Category;

class Want_itemController extends Controller
{
    // public function want_list_add()
    // {
    //     return view('want.want_list');
    // }
    
    public function want_list()
  {
      return redirect('want.want_list');
  }
    
    
    
    public function want_add()
    {
      return view('want.want_create');
    }
    
    public function want_create(Request $request)
    {
        //Varidationを行う
        $this->varidate($request, Want_item::$rules);
        
        $want_items = new Want_item;
        $form = $request->all();
        
        // create画面のフォームから画像が送信されてきたら、保存して、$bought_items->image_path に画像のパスを保存する
        if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $want_items->image_path = basename($path);
      } else {
          $want_items->image_path = null;
      }
      
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);
        
        // データベースに保存する
        $want_items->fill($form);
        //カテゴリーの名前と画像が表示ができるように
        $want_items->category_id=$request->category_id; 
        //userのidをリスト登録画面で読み込めるようにした
        $want_items->user_id=Auth::id();
        
        $want_items->save();
      
      return redirect('want/want_create');
    }
    
    public function index(Request $request)
  {
      $cond_name = $request->cond_name;
      $cid = $request->cid;
      
      if ($cond_name != '') {
          // キーワード検索されたら検索結果を取得する
            $posts = Want_item::where('name','like','%'. $cond_name.'%')->orWhere('sitename','like','%'.$cond_name.'%')->orderBy('created_at','desc')->get();
      } else if ($cid != ''){
          //カテゴリー検索されたら検索結果取得
            $posts = Category::find($cid)->want_items->sortByDesc('created_at');
      
      } else{
            $posts = Want_item::all()->sortByDesc('created_at');
      }
      
      
      return view('want.want_list', ['posts' => $posts, 'cond_name' => $cond_name]);
  }
    
}
