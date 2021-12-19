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
        <title>買ったものリスト（月単位）</title>

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
        <link href="{{ asset('css/bought_carender.css') }}" rel="stylesheet">
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
                    {{$currentMonth}}
                    {{$name[0]}}
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              @foreach (['日', '月', '火', '水', '木', '金', '土'] as $dayOfWeek)
                              <th>{{ $dayOfWeek }}</th>
                              @endforeach
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($dates as $date)
                            @if ($date[0]->dayOfWeek == 0)
                            <tr>
                            @endif
                              <td
                                @if ($date[0]->month != $currentMonth)
                                class="bg-secondary"
                                @endif
                              >
                                {{ $date[0]->day }}
                                {{ $date[1] }}
                              </td>
                            @if ($date[0]->dayOfWeek == 6)
                            </tr>
                            @endif
                            @endforeach
                          </tbody>
                        </table>
                    
                
                </div>
            </main>
        </div>
    </body>
</html>