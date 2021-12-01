<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Bought;

class BoughtforController extends Controller
{
    //
     public function index()
  {
      return view('boughtfor.index');
  }
  
  
   public function bought_add()
  {
      return view('bought.bought_list');
  }
  
  public function bought_list()
  {
      return view('bought.bought_list');
  }
  
  
  public function register_add()
  {
      return view('auth.register');
  }
  
  public function register_create()
  {
      return view('auth.register');
  }
}
