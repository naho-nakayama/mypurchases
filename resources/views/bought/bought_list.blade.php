@extends('layouts.bought')

          @section('title', '買ったものリスト')
　
@section('content')

    <div class="container">
        <div class="row">
            <div class="pull-left">
                 <button type="button" class="btn btn-outline-info btn-lg" onclick="location.href='{{ action('Admin\Bought_itemController@bought_add') }}'">リストに追加</button>
            </div>
        </div>
        
        <div class="row">
            <div class="bought_list col-md-12 mx-auto">
                <table class="table table-boredered">
                    <thead>
                        <tr>
                            <th width="20%">ID</th>
                            <th width="20%">買った日付</th>
                            <th width="20%">買ったもの</th>
                            <th width="20%">値段</th>
                            <th width="20%">サイト名</th>
                            <!--<th width="10%">操作</th>-->
                        </tr>
                    </thead>
                    
                    <tbody>
                            @foreach($posts as $bought_item)
                                <tr>
                                    <th>{{ $bought_item->id }}</th>
                                    <td>{{ str_limit($bought_item->date, 100) }}</td>
                                    <td>{{ str_limit($bought_item->name, 100) }}</td>
                                    <td>{{ str_limit($bought_item->price, 100) }}</td>
                                    <td>{{ str_limit($bought_item->sitename, 100) }}</td>
                                   
                                </tr>
                            @endforeach
                        </tbody>
                        
                </table>
            </div>    
        </div>
        
    </div>
@endsection