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
        // if($request->'date' == $preFirstDate){
        //     new Carbon( $preFirstDate);
        // }else if($request->'date' == $nxtFirstDate){
        //     new Carbon( $nxtFirstDate);
        // }else{
        //     Carbon::now();
        // }
    $dateStr = sprintf('%04d-%02d-01', $now->year, $now->month);
    $date = new Carbon( $dateStr);
    // カレンダーを四角形にするため、前月となる左上の隙間用のデータを入れるためずらす
    $date->subDay($date->dayOfWeek);
    // 同上。右下の隙間のための計算。
    $count = 31 + $date->dayOfWeek;
    $count = ceil($count / 7) * 7;
    $dates = [];

   
    for ($i = 0; $i < $count; $i++, $date->addDay()) {
       
        $dates[] = [
            "date"=> $date->copy(),
            "bought_items" => Bought_item::whereDate('date', '=', $date)->get()
        ];
        
       
        }
    
     $tmpDate = new Carbon($dateStr);
     
        $preFirstDate = $tmpDate->startOfMonth()->subMonthNoOverflow()->toDateString();
        $tmpDate = new Carbon($dateStr);
        $nxtFirstDate = $tmpDate->startOfMonth()->addMonth()->toDateString();
        // dd($firstDate->toDateString(), $firstDate->addMonth()->toDateString());
        if($dateStr < $nxtFirstDate){
            $nxtFirstDate = null;
        }
        // dd($preFirstDate, $tmpDate->toDateString(), $nxtFirstDate);
        
        
      return view('bought.bought_carender',['dates' =>$dates,'currentMonth'=> $now->month,
        'preFirstDate' => $preFirstDate,'nxtFirstDate' => $nxtFirstDate]);
  }
  
  
  public function bought_carender()
  {
    
      
      return redirect('bought.bought_carender');
  }
  
  
}
