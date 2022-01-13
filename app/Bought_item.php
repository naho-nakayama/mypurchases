<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Bought_item extends Model
{
    protected $guarded = array('id');
    protected $dates = [
        'date',
    ];

    // データを飛ばしてくるinputのname名
    public static $rules = array(
        'name' => 'required',
        'price' => 'required',
        'sitename' => 'required',
        'image' => 'max:2048'  //アップロードできるファイルサイズを２MBまでにする
       
    );
  
    //カーボンで作った日付の表示方法変更
    function getFormatedDate()
    {
        return $this->date ? Carbon::parse($this->date)->format('Y/m/d') : null;
    }
    
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
