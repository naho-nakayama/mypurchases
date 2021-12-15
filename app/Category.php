<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function bought_items(){
        return $this->hasMany('App\Bought_item');
    }
}
