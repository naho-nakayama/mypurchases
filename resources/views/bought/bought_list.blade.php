@extends('layouts.bought')

          @section('title', '買ったものリスト')
　
@section('content')

    <div class="container">
        <div class="row">
            <div class="pull-left">
                
                 <button type="button" class="btn btn-outline-info btn-lg" onclick="location.href='{{ action('Admin\BoughtController@bought_add') }}'">リストに追加</button>
                
            </div>
        </div>
    </div>
@endsection