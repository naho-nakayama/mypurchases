@extends('layouts.bought')

@section('title', '買ったものリスト（1日単位）')
　
@section('content')

    <div class="container">
        <div class="row">
            <div class="bought_list col-md-12 mx-auto">
                <table>
                    <thead>
                        <tr>
                            <th width="15%"></th>
                            <th width="15%"></th>
                            <th width="15%"></th>
                            <th width="15%"></th>
                            <th width="18%"></th>
                            <th width="18%"></th>
                            <th width="4%"></th>
                        
                        </tr>
                    </thead>
                    
                    <tbody class="table table-boredered">
                            @foreach($posts as $bought_item)
                                <tr>
                                    <td class = "text-left">{{ $bought_item->getFormatedDate()}}</td>
                                    <td class = "text-center">{{ $bought_item->name }}</td>
                                    <td class = "text-center">{{ $bought_item->price }}</td>
                                    <td class = "text-center">{{ str_limit($bought_item->sitename, 60) }}</td>
                                    <td class = "text-center">{{ str_limit($bought_item->category->name,60) }}</td>
                                    <td class = "text-center"><image src={{ secure_asset($bought_item->image_path) }} onerror="this.src='https://i.gyazo.com/4324bf041da262cf2e9bf72eec992e5c.jpg';" alt="画像" width="160" height="110" ></td>
                                   
                                   <td>
                                        <div>
                                            <button type="button"class="btn btn-outline-secondary" onclick="location.href='{{ action('Admin\Bought_itemController@edit', ['id' => $bought_item->id]) }}'">編集</button>
                                        </div>
                                        <div>
                                            <button type="button"class="btn btn-outline-secondary" onclick="location.href='{{ action('Admin\Bought_itemController@delete', ['id' => $bought_item->id]) }}'">削除</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                </table>
            </div>    
        </div>
        <div class ="row">
            <div class ="col-md-5 text-left">
            </div>
            <div class ="col-md-4 text-cemter pagenate">
                {{ $posts->links() }}
            </div>
            <div class ="col-md-3 text-right">
            </div>
        </div>
    </div>
@endsection