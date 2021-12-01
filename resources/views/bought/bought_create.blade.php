@extends('layouts.bought')

          @section('title', '買ったものリスト登録画面')
　
@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>リストに追加する</h2>
                <form action="{{ action('Admin\BoughtController@bought_create') }}" method="post" enctype="multipart/form-data">

 　{{--Validationでエラーを見つけたときには、Laravel が自動的に $errors という変数にエラーを格納--}}

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="bought_name">買ったものは？</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="bought_name" value="{{ old('bought_name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="bought_price">金額は？</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="bought_price" value="{{ old('bought_price') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="bought_sitename">サイト名は？</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="bought_sitename" value="{{ old('bought_sitename') }}">
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-md-2" for="bought_name">もののカテゴリーは？</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="category_id" value="{{ old('category_id') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection