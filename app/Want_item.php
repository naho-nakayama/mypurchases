<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Want_item extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'name' => 'required',
        'price' => 'required',
        'sitename' => 'required',
       
    );
    
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
