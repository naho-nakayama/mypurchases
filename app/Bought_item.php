<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Bought_item extends Model
{
    protected $guarded = array('id');

    // bought_items tableの中身
    public static $rules = array(
        'name' => 'required',
        'price' => 'required',
        'sitename' => 'required',
       
    );
    
    function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y/m/d') : null;
    }
    
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
