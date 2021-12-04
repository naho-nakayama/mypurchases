<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bought_item extends Model
{
    protected $guarded = array('id');

    // bought_items tableの中身
    public static $rules = array(
        'name' => 'required',
        'price' => 'required',
        'sitename' => 'required',
       
    );
}
