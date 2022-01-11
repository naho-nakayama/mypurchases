<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Scripts -->
         {{-- Laravel標準で用意されているJavascriptを読み込み --}}
        <script src="{{ secure_asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準で用意されているCSSを読み込み --}}
         <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{-- 買ったものリストのCSSを読み込みます --}}
        <link href="{{ asset('css/bought.css') }}" rel="stylesheet">
    </head>
    <body class ="boughtList">
        <div id="app">  {{-- Vue.js用 Javascriptでエラー出ないため--}}
            <header class ="sticky-top">
                <nav class="navbar navbar-expand-md navbar-light navbar-bought_list">
                    <div class="container">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">
                                {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                                @guest
                                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a></li>
                                {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                                @else
                                    <li class="welcome">ようこそ</li>
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
                            </ul>
                                
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auton">
                                <li class="nav-item">
                                    <a class="nav-link active toWant" href="{{ action('Admin\Want_itemController@index') }}">買いたいものリストへ<i class="arrowIcon_right"></i><i class="arrowIcon_right"></i>︎</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <h1 class="display-5">買ったものリスト</h1>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <div class="col-4">
                            <form class="form-inline my-2 my-lg-0" action="{{ action('Admin\Bought_itemController@index') }}" method="get">
                                <input class="form-control mr-sm-2" type="search" placeholder="{{ __('messages.Purchases_Sitename_Input') }}" aria-label="Purchases_Sitename_Input" name="cond_name" value="{{ $cond_name }}">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="検索">{{ __('messages.Search') }}</button>
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                
                
                    <div class="row">
                        <div class="col-10">
                        </div>
                        <div class="col-2">
                            <form class="form-inline my-2 my-lg-0" action="{{ action('Admin\Bought_itemController@index') }}" method="get">
                                <div class="dropdown">
                                    <button class="btn btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                    カテゴリ検索
                                    </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ action('Admin\Bought_itemController@index') . '?cid=1'}}">衣類</a>
                                        <a class="dropdown-item" href="{{ action('Admin\Bought_itemController@index') . '?cid=2'}}">食べ物・飲み物</a>
                                        <a class="dropdown-item" href="{{ action('Admin\Bought_itemController@index') . '?cid=3'}}">本</a>
                                        <a class="dropdown-item" href="{{ action('Admin\Bought_itemController@index') . '?cid=4'}}">日用品</a>
                                        <a class="dropdown-item" href="{{ action('Admin\Bought_itemController@index') . '?cid=5'}}">雑貨</a>
                                        <a class="dropdown-item" href="{{ action('Admin\Bought_itemController@index') . '?cid=6'}}">アクセサリー</a>
                                        <a class="dropdown-item" href="{{ action('Admin\Bought_itemController@index') . '?cid=7'}}">化粧品・スキンケア</a>
                                        <a class="dropdown-item" href="{{ action('Admin\Bought_itemController@index') . '?cid=8'}}">ゲーム</a>
                                        <a class="dropdown-item" href="{{ action('Admin\Bought_itemController@index') . '?cid=9'}}">機器</a>
                                        <a class="dropdown-item" href="{{ action('Admin\Bought_itemController@index') . '?cid=10'}}">その他</a>
                                        </div>
                                        {{ csrf_field() }}
                                </div>
                            </form>    
                        </div>
                    </div>
                    
                    <br>
                    <div class="row">
                        <div class="col-md-2 text-left">
                            <div class="dropdown">
                                <button class="btn btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                日ごとに表示
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ action('Admin\Bought_carenderController@bought_carender_add')}}">カレンダーで表示</a>
                                </div>
                            </div>
                        </div>
                        <div class= "col-md-8 text-center">
                            
                        </div>
                        <div class= "col-md-2 text-right addList">
                            <button type="button" class="btn btn-outline-info btn-lg" onclick="location.href='{{ action('Admin\Bought_itemController@bought_add') }}'">リストに追加</button>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="bought_list col-md-12 mx-auto">
                            <table class="table table-boredered listMenu">
                                <thead>
                                    <tr>
                                        <th width="15%">買った日付</th>
                                        <th width="15%">買ったもの</th>
                                        <th width="15%">値段（円）</th>
                                        <th width="15%">サイト名</th>
                                        <th width="18%">カテゴリー</th>
                                        <th width="18%">画像</th>
                                        <th width="4%"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </header>


            <main>
                
                    {{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}
                    @yield('content')
            
                    
            
            </main>
        </div>
    </body>
</html>