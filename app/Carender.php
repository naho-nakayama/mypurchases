<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Carender extends Model
{
    public function getNextMonth(){
		return $this->carbon->copy()->addMonthsNoOverflow()->format('Y-m');
	}
	/**
	 * 前の月
	 */
	public function getPreviousMonth(){
		return $this->carbon->copy()->subMonthsNoOverflow()->format('Y-m');
	}
    
}
