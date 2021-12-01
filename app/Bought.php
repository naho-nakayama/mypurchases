<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bought extends Model
{
    protected $guarded = array('id');

    // bought tableの中身
    public static $rules = array(
        'bought_name' => 'required',
        'bought_price' => 'required',
        'bought_sitename' => 'required',
       
    );
}
