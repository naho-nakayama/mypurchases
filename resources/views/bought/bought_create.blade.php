<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
         {{-- 後の章で説明します --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}
        <title>買ったものリスト登録画面</title>

        <!-- Scripts -->
         {{-- Laravel標準で用意されているJavascriptを読み込みます --}}
        <script src="{{ secure_asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準で用意されているCSSを読み込みます --}}
         <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{-- この章の後半で作成するCSSを読み込みます --}}
        <link href="{{ asset('css/bought.css') }}" rel="stylesheet">
    </head>
    
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-bought_list">
                <div class="container">
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            {{-- 以下を追記12ユーザー認証実装 --}}
                        <!-- Authentication Links -->
                        {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a></li>
                        {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('messages.Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                            {{-- 以上までを追記 --}}
                        </ul>
                    </div>
                </div>
        </nav>
       
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <h1 class="display-5">リストに追加する</h1>
                        <br>
                        <form action="{{ action('Admin\Bought_itemController@bought_create') }}" method="post" enctype="multipart/form-data">
        
         　{{--Validationでエラーを見つけたときには、Laravel が自動的に $errors という変数にエラーを格納--}}
        
                            @if (count($errors) > 0)
                                <ul>
                                    @foreach($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="list_register_box">
                                <div class="form-group row">
                                    <label class="col-md-3" for="bought_sitename">買った日付は？</label>
                                    <div class="col-md-3">
                                        <input type="date" class="form-control" name="date" value="{{ old('date',  Carbon\Carbon::today()->format('Y-m-d')) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="name">買ったものは？</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="price">金額は？</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="bought_sitename">サイト名は？</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="sitename" value="{{ old('sitename') }}">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3" for="category">もののカテゴリーは？</label>
                                    <div class="col-md-9">
                                        <div class="select_box">
                                            <select name="category_id">
                                                <option value="1">衣類</option>
                                                <option value="2">食べ物</option>
                                                <option value="3">本</option>
                                            </select>
                                        </div>
                                        <!--<input type="text" class="form-control" name="name" value="{{ old('name') }}">-->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="title">ものの画像</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control-file" name="image">
                                    </div>
                                </div>
                            </div>
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-outline-info btn-lg" value="登録">
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>