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
                <div class="table">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="20%">買ったもの</th>
                            <th width="20%">値段</th>
                            <th width="20%">サイト名</th>
                            <!--<th width="10%">操作</th>-->
                        </tr>
                    </thead>
                    
                    <tbody>
                            @foreach($posts as $bought_items)
                                <tr>
                                    <th>{{ $bought_items->id }}</th>
                                    <td>{{ str_limit($bought_items->name, 100) }}</td>
                                    <td>{{ str_limit($bought_items->price, 100) }}</td>
                                    <td>{{ str_limit($bought_items->sitename, 100) }}</td>
                                    <!--<td>-->
                                    <!--    <div>-->
                                    <!--        <a href="{{ action('Admin\NewsController@edit', ['id' => $bought_items->id]) }}">編集</a>-->
                                    <!--    </div>-->
                                    <!--     <div>-->
                                    <!--        <a href="{{ action('Admin\NewsController@delete', ['id' => $bought_items->id]) }}">削除</a>-->
                                    <!--    </div>-->
                                    <!--</td>-->
                                </tr>
                            @endforeach
                        </tbody>
                        
                </div>
            </div>    
        </div>
        
    </div>
@endsection