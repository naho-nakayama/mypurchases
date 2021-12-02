@extends('layouts.bought')

          @section('title', '買ったものリスト')
　
@section('content')

    <div class="container">
        <div class="row">
            <div class="pull-left">
                 <button type="button" class="btn btn-outline-info btn-lg" onclick="location.href='{{ action('Admin\BoughtController@bought_add') }}'">リストに追加</button>
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
                            <th width="20%">サイト</th>
                            <!--<th width="10%">操作</th>-->
                        </tr>
                    </thead>
                    
                    <tbody>
                            @foreach($posts as $bought)
                                <tr>
                                    <th>{{ $bought->id }}</th>
                                    <td>{{ str_limit($bought->bought_name, 100) }}</td>
                                    <td>{{ str_limit($bought->bought_price, 100) }}</td>
                                    <td>{{ str_limit($bought->bought_sitename, 100) }}</td>
                                    <!--<td>-->
                                    <!--    <div>-->
                                    <!--        <a href="{{ action('Admin\NewsController@edit', ['id' => $bought->id]) }}">編集</a>-->
                                    <!--    </div>-->
                                    <!--     <div>-->
                                    <!--        <a href="{{ action('Admin\NewsController@delete', ['id' => $bought->id]) }}">削除</a>-->
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