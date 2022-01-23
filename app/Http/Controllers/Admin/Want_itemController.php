<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Want_item;
use Auth;
use App\Category;
//画像の保存先のS3使用
use Storage;


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
        $this->validate($request, Want_item::$rules);
        
        $want_items = new Want_item;
        $form = $request->all();
        
        // create画面のフォームから画像が送信されてきたら、保存して、S3に保存する
        if (isset($form['image'])) {
        $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        $want_items->image_path = Storage::disk('s3')->url($path);
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
      $cond_sitename = $request->cond_sitename;
      $cid = $request->cid;
      
      if ($cond_name != '') {
          // 買いたいものの名前検索されたら検索結果を取得する
            $posts = Auth::user()->want_items()->where('name','like','%'. $cond_name.'%')->orderBy('created_at','desc')->paginate(10);
      }else if($cond_sitename != '') {
         // 買いたいもののサイト名検索されたら検索結果を取得する
             $posts = Auth::user()->want_items()->where('sitename','like','%'.$cond_sitename.'%')->orderBy('created_at','desc')->paginate(10);
        
      }else if ($cid != ''){
          //カテゴリー検索されたら検索結果取得
            $posts = Auth::user()->want_items()->where('category_id',$cid)->paginate(10);
      
      } else{
            $posts = Auth::user()->want_items()->orderBy('created_at','desc')->paginate(10);
      }
      
      
      return view('want.want_list', ['posts' => $posts, 'cond_name' => $cond_name, 'cond_sitename'=> $cond_sitename]);
  }
  
    public function edit(Request $request)
  {
      // Want_item Modelからデータを取得する
      $want_item = Want_item::find($request->id);
      //categoriesテーブルからCategoryモデルを使ってデータを全て取得して変数に代入
      $category = Category::all();
      if (empty($want_item)) {
        abort(404);    
      }
      return view('want.want_edit', ['want_item_form' => $want_item ,'category'=>$category]);
  }
  
    public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Want_item::$rules);
      // Want_item Modelからデータを検索して取得する
      $want_item = Auth::user()->want_items()->find($request->id);
      // 送信されてきたフォームデータを格納する
      $want_item_form = $request->all();
      if ($request->remove == 'true') {
          $want_item_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = Storage::disk('s3')->putFile('/',$request->file('image'),'public');
          $want_item_form['image_path'] = Storage::disk('s3')->url($path);
      } else {
          $want_item_form['image_path'] = $want_item->image_path;
      }

      unset($want_item_form['image']);
      unset($want_item_form['remove']);
      unset($want_item_form['_token']);
      // 該当するデータを上書きして保存する
      $want_item->fill($want_item_form)->save();
      return redirect('want/want_list');
  }
  
    public function delete(Request $request)
  {
      // 該当するBought_item Modelを取得
      $want_item = Auth::user()->want_items()->find($request->id);
      // 削除する
      $want_item->delete();
      return redirect('want/want_list');
  }
    
}
