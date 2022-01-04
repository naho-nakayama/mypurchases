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

        //以下カレンダーでのカテゴリー、キーワード検索
        $query = Bought_item::query();
        
        if($request->cond_name){
            $query->where('name','like','%'. $request->cond_name.'%')->orWhere('sitename','like','%'.$request->cond_name.'%');
        }elseif($request->cid){
            $query->where('category_id',$request->cid);
        }else{
            $query = Bought_item::query();
        }
        $bought_items = $query->get();
        // dd($bought_items,$request->cond_name);
        
        for ($i = 0; $i < $count; $i++, $date->addDay()) {
        
            $dates[] = [
                "date"=> $date->copy(),
                "bought_items" => $bought_items->filter(function ($value, $key)use($date) {
                   
                    return $value->date == $date;
                })
            ];
        }
        // dd($dates,$bought_items,$count);
        
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
