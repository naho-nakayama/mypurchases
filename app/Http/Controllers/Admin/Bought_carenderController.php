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
        if($request->date !== null){
        $now = new Carbon( $request->date);
        }else{
        $now = Carbon::now();
        }
        
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
        
        //前の月を取ってくる↓
        $tmpDate = new Carbon($dateStr);
        $preFirstDate = $tmpDate->startOfMonth()->subMonthNoOverflow()->toDateString();
        //次の月を取ってくる↓
        $tmpDate = new Carbon($dateStr);
        $nxtFirstDate = $tmpDate->startOfMonth()->addMonth()->toDateString();
        $cmpDate =Carbon::now()->startOfMonth()->toDateString();
        // dd($firstDate->toDateString(), $firstDate->addMonth()->toDateString());
        if( $cmpDate < $nxtFirstDate){
            $nxtFirstDate = null;
        }
        // dd($preFirstDate, $tmpDate->toDateString(), $nxtFirstDate);
        
        
      return view('bought.bought_carender',['dates' =>$dates,'currentMonth'=> $now->month,
        'preFirstDate' => $preFirstDate,'nxtFirstDate' => $nxtFirstDate, 'currentYear'=> $now->year]);
  }
  
  
  public function bought_oneday(Request $request)
  {
        
      
      return redirect('bought.bought_carender');
  }
  
  
}
