<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; //DB::の書き方を使うためのもの
use App\Bought_item;

//以下の記述でララベルのAuth機能が使えるように
use Auth;

class Bought_carenderController extends Controller
{
    public function bought_carender_add(Request $request)
  {
        if($request->date !== null){
            $now = new Carbon( $request->date);
        }else{
            $now = Carbon::now();
        }
        
        //以下カレンダーでのカテゴリー、キーワード検索
        $query = Auth::user()->bought_items();
        $cond_params = []; //検索条件を保持してリンクに渡すための連想配列
        
        if($request->cond_name){
            $query->where('name','like','%'. $request->cond_name.'%');
            $cond_params["cond_name"] = $request->cond_name;
        }elseif($request->cond_sitename){
            $query->where('sitename','like','%'.$request->cond_sitename.'%');
            $cond_params["cond_sitename"] = $request->cond_sitename;    
        }elseif($request->cid){
            $query->where('category_id',$request->cid);
            $cond_params["cid"] = $request->cid;
        }
        
        $bought_items = $query->get();

        //カレンダー生成・データを持ってくる
        $fistday_in_month = Carbon::create($now->year, $now->month, "1");
        $lastday_in_month =  Carbon::create($now->year, $now->month, $fistday_in_month->daysInMonth);
        $cel_date = $fistday_in_month->copy();
        // カレンダーを四角形にするため、前月となる左上の隙間用のデータを入れるためずらす
        $cel_date->subDay($cel_date->dayOfWeek); // 0。週のうちの何日目か 0 (日曜)から 6 (土曜)
        
        $dates = [];
             //   dd($lastday_in_month,$cel_date);
        while(!($cel_date > $lastday_in_month && $cel_date->dayOfWeek == 0)) {
            $dates[] = [
                "date"=> $cel_date->copy(),
                "bought_items" => $bought_items->filter(function ($value, $key)use($cel_date) {
                    return $value->date == $cel_date;
                })
            ];
            $cel_date->addDay();
        }
        // dd($dates,$bought_items,$count);
        //前の月を取ってくる↓
        $preFirstDate = $fistday_in_month->copy()->startOfMonth()->subMonthNoOverflow()->toDateString();
        //次の月を取ってくる↓
        $nxtFirstDate = $fistday_in_month->copy()->startOfMonth()->addMonth()->toDateString();
        $cmpDate =Carbon::now()->startOfMonth()->toDateString();
        // dd($firstDate->toDateString(), $firstDate->addMonth()->toDateString());
        if( $cmpDate < $nxtFirstDate){
            $nxtFirstDate = null;
        }
        // dd($preFirstDate, $tmpDate->toDateString(), $nxtFirstDate);
      return view('bought.bought_carender',['dates' =>$dates,'currentMonth'=> $now->month,
        'preFirstDate' => $preFirstDate,'nxtFirstDate' => $nxtFirstDate, 'currentYear'=> $now->year, 'cond_params'=>$cond_params]);
  }
  
  
  public function bought_oneday(Request $request)
  {
        
      
      return redirect('bought.bought_carender');
  }
  
  
}
