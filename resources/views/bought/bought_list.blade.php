@extends('layouts.bought')

          @section('title', '買ったものリスト（日にち単位）')
　
@section('content')

    <div class="container">
        <div class="row">
            <div class="pull-left">
                 <button type="button" class="btn btn-outline-info btn-lg" onclick="location.href='{{ action('Admin\Bought_itemController@bought_add') }}'">リストに追加</button>
            </div>
        </div>
        
        <div class="row">
            <div class= "pull-left">
                <div class="dropdown">
                    <button class="btn btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                    リスト表示方法
                    </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ action('Admin\Bought_carenderController@bought_carender_add')}}">月単位</a>
                        </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="bought_list col-md-12 mx-auto">
                <table class="table table-boredered">
                    <thead>
                        <tr>
                            <th width="15%">買った日付</th>
                            <th width="15%">買ったもの</th>
                            <th width="15%">値段（円）</th>
                            <th width="15%">サイト名</th>
                            <th width="15%">カテゴリー</th>
                            <th width="20%">画像</th>
                            <!--<th width="10%">操作</th>-->
                        </tr>
                    </thead>
                    
                    <tbody>
                            @foreach($posts as $bought_item)
                                <tr>
                                    <td>{{ $bought_item->getFormatedDate()}}</td>
                                    <td>{{ str_limit($bought_item->name, 60) }}</td>
                                    <td>{{ str_limit($bought_item->price, 60) }}</td>
                                    <td>{{ str_limit($bought_item->sitename, 60) }}</td>
                                    <td>{{ str_limit($bought_item->category->name,60) }}</td>
                                    <td><image src={{ secure_asset('storage/image/'.$bought_item->image_path) }} onerror="this.src='https://i.gyazo.com/4324bf041da262cf2e9bf72eec992e5c.jpg';" alt="画像" width="160" height="110" ></td>
                                   
                                   <td>
                                        <div>
                                            <a href="{{ action('Admin\Bought_itemController@edit', ['id' => $bought_item->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <a href="{{ action('Admin\Bought_itemController@delete', ['id' => $bought_item->id]) }}">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                </table>
            </div>    
        </div>
        
    </div>
@endsection