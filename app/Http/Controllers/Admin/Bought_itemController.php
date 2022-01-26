<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 以下を追記することでBought Modelが扱えるようになる
use App\Bought_item;
//以下の記述でララベルのAuth機能が使えるように
use Auth;
use Carbon\Carbon;
//カテゴリーのテーブルを使うためモデル名を記述
use App\Category;
//画像の保存先のS3使用
use Storage;


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
      
      // create画面のフォームから画像が送信されてきたら、保存して、S3に保存する
      if (isset($form['image'])) {
        $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        $bought_items->image_path = Storage::disk('s3')->url($path);
      } else {
          $bought_items->image_path = null;
      }
      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      
      
      // データベースに保存する
      $bought_items->fill($form);
      //カテゴリーの名前と画像が表示ができるように
      $bought_items->category_id=$request->category_id; 
      //userのidをリスト登録画面で読み込めるようにした
      $bought_items->user_id=Auth::id();
      
      // dd($form,$bought_items);
      $bought_items->save();
      
      return redirect('bought/bought_create');
  }
      
      
      public function index(Request $request)
  {
      $cond_name = $request->cond_name;
      $cond_sitename = $request->cond_sitename;
      $cid = $request->cid;
      $cond_day = $request->date;
      
      if ($cond_name != '') {
          // 買ったものの名前検索されたら検索結果を取得する
            $posts = Auth::user()->bought_items()->where('name','like','%'. $cond_name.'%')->orderBy('created_at','desc')->paginate(10);
           
      }else if ($cond_sitename != ''){
          // 買ったもののサイト名検索されたら検索結果を取得する
            $posts = Auth::user()->bought_items()->where('sitename','like','%'.$cond_sitename.'%')->orderBy('created_at','desc')->paginate(10);
            
      }else if ($cid != ''){
          //カテゴリー検索されたら検索結果取得
            $posts = Auth::user()->bought_items()->where('category_id',$cid)->orderBy('created_at','desc')->paginate(10);
      } else if($cond_day != ''){
          //カレンダーから日付で検索されたら該当のリスト
            $posts = Auth::user()->bought_items()->where('date', $cond_day)->paginate(10);
      
      } else{
            $posts = Auth::user()->bought_items()->orderBy('created_at','desc')->paginate(10);
      }
      ddd($posts);
      
      return view('bought.bought_list', ['posts' => $posts, 'cond_name' => $cond_name,'cond_sitename'=> $cond_sitename ]);
  }
  
  
  
  public function edit(Request $request)
  {
      // Bought_item Modelからデータを取得する
      $bought_item = Bought_item::find($request->id);
      //categoriesテーブルからCategoryモデルを使ってデータを全て取得して変数に代入
      $category = Category::all();
      if (empty($bought_item)) {
        abort(404);    
      }
      return view('bought.bought_edit', ['bought_item_form' => $bought_item ,'category'=>$category]);
  }
  
  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Bought_item::$rules);
      // Bought_item Modelからデータを検索して取得する
      $bought_item = Auth::user()->bought_items()->find($request->id);
      // 送信されてきたフォームデータを格納する
      $bought_item_form = Auth::user()->bought_items()->$request->all();
      if ($request->remove == 'true') {
          $bought_item_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = Storage::disk('s3')->putFile('/',$request->file('image'),'public');
          $bought_item_form['image_path'] = Storage::disk('s3')->url($path);
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
      $bought_item =  Auth::user()->bought_items()->find($request->id);
      // 削除する
      $bought_item->delete();
      return redirect('bought/bought_list');
  }
}
