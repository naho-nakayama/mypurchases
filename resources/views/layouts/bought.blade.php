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
        <title>@yield('title')</title>

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
        <div id="app">  {{-- Vue.js用 Javascriptでエラー出ないため--}}
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
                            {{-- 以上までを追記 --}}
                        </ul>
                    </div>
                </div>
            </nav>



           <main>
             <div class="container">
                 <div class="row row align-items-center">
                  <div class="col align-self-start">
                   <h1 class="display-4">買ったものリスト</h1>
                  </div>
                 </div>
                 
                 
                 <div class="row">
                    <div class="col-8">
                    </div>
                    <div class="col-4">
                      <form class="form-inline my-2 my-lg-0" action="{{ action('Admin\Bought_itemController@index') }}" method="get">
                        <input class="form-control mr-sm-2" type="search" placeholder="{{ __('messages.Keyword_Search') }}" aria-label="Keyword_Search" name="cond_name" value="{{ $cond_name }}">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="検索">{{ __('messages.Search') }}</button>
                        {{ csrf_field() }}
                      </form>
                    </div>
                  </div>
                  
                  
                  <div class="row">
                   <div class="col-10">
                   </div>
                   <div class="col-2">
                    <div class="dropdown">
                      <button class="btn btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                          カテゴリ検索
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                     </div>
                    </div>
                 </div>
                 
             </div>
                {{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}
                @yield('content')
                
                
                
            </main>
        </div>
    </body>
</html>