<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; //DB::の書き方を使うためのもの
use App\Bought_item;

class Bought_carenderController extends Controller
{
    public function bought_carender_add(Request $request)
  {
    $now = Carbon::now();
    $dateStr = sprintf('%04d-%02d-01', $now->year, $now->month);
    $date = new Carbon( $dateStr);
    // カレンダーを四角形にするため、前月となる左上の隙間用のデータを入れるためずらす
    $date->subDay($date->dayOfWeek);
    // 同上。右下の隙間のための計算。
    $count = 31 + $date->dayOfWeek;
    $count = ceil($count / 7) * 7;
    $dates = [];

    $items= DB::table('bought_items')->whereYear('date','2021')->whereMonth('date', '12')->get();
    foreach($items as $item){
        $match_date[]= date("Y-m-d",strtotime($item->date));
        $match_name[]=$item->name;
    }
    $j=0;
    for ($i = 0; $i < $count; $i++, $date->addDay()) {
       if(in_array($date->copy(),$match_date)){
           $dates[]=[$date->copy(),$match_name[$j]];
           $j++;
       }else{
            $dates[] = [$date->copy(),null];
       }
        
        // copyしないと全部同じオブジェクトを入れてしまうことになる
        // $dates[] = $date->copy();
    }
      return view('bought.bought_carender',['dates' =>$dates,'currentMonth'=> $now->month,'name' => $match_date]);
  }
  
  
  public function bought_carender()
  {
    
      
      return redirect('bought.bought_carender');
  }
  
  
}
