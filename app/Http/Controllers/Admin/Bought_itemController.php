<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 以下を追記することでBought Modelが扱えるようになる
use App\Bought_item;
//以下の記述でララベルのAuth機能が使えるように？
use Auth;
use Carbon\Carbon;

class Bought_itemController extends Controller
{
   public function bought_list_add()
  {
      return view('bought.bought_list');
  }
  
  public function bought_list()
  {
      return redirect('bought.bought_list');
  }
  
  public function bought_add()
  {
      return view('bought.bought_create');
  }
  
  public function bought_create(Request $request)
  {
   
   // Varidationを行う
      $this->validate($request, Bought_item::$rules);
      
      $bought_items = new Bought_item;
      $form = $request->all();
      
      // create画面のフォームから画像が送信されてきたら、保存して、$bought_items->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $bought_items->image_path = basename($path);
      } else {
          $bought_items->image_path = null;
      }
      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      
      
      // データベースに保存する
      $bought_items->fill($form);
      //とりあえずカテゴリーを表示できるようにした。カテゴリ選べるように登録したらこの記述は削除
      $bought_items->category_id=1; 
      //userのidをリスト登録画面で読み込めるようにした
      $bought_items->user_id=Auth::id();
      
      // dd($form,$bought_items);
      $bought_items->save();
      
      return redirect('bought/bought_create');
  }
      
      
      public function index(Request $request)
  {
      $cond_name = $request->cond_name;
      if ($cond_name != '') {
          // キーワード検索されたら検索結果を取得する
          $posts = Bought_item::where('bought_name', $cond_name)->get();
      } else {
          // それ以外はすべての買ったものリストを取得する
          $posts = Bought_item::all();
      }
      return view('bought.bought_list', ['posts' => $posts, 'cond_name' => $cond_name]);
  }
  
  
  
  public function edit(Request $request)
  {
      // Bought_item Modelからデータを取得する
      $bought_item = Bought_item::find($request->id);
      if (empty($bought_item)) {
        abort(404);    
      }
      return view('bought.bought_edit', ['bought_item_form' => $bought_item]);
  }
  
  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Bought_item::$rules);
      // Bought_item Modelからデータを取得する
      $bought_item = Bought_item::find($request->id);
      // 送信されてきたフォームデータを格納する
      $bought_item_form = $request->all();
      if ($request->remove == 'true') {
          $bought_item_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = $request->file('image')->store('public/image');
          $bought_item_form['image_path'] = basename($path);
      } else {
          $bought_item_form['image_path'] = $bought_item->image_path;
      }

      unset($bought_item_form['image']);
      unset($bought_item_form['remove']);
      unset($bought_item_form['_token']);
      // 該当するデータを上書きして保存する
      $bought_item->fill($bought_item_form)->save();
      return redirect('bought/bought_list');
  }
  
  
  public function delete(Request $request)
  {
      // 該当するBought_item Modelを取得
      $bought_item = Bought_item::find($request->id);
      // 削除する
      $bought_item->delete();
      return redirect('bought/bought_list');
  }
}