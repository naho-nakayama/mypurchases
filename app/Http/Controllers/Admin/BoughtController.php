<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoughtController extends Controller
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
      $this->validate($request, Bought::$rules);
      
      $bought = new Bought;
      $form = $request->all();
      
      // create画面のフォームから画像が送信されてきたら、保存して、$bought->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $bought->image_path = basename($path);
      } else {
          $bought->image_path = null;
      }
      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      
      
      // データベースに保存する
      $bought->fill($form);
      $bought->save();
      
      return redirect('bought/bought_create');
  }
  
}
