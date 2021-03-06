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
        <link href="{{ asset('css/front.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">  {{-- Vue.js用 Javascriptでエラー出ないため--}}
            <main>
                <div class="container loginForm">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="balloon">
                                <p>ネットで</p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="title">
                                <h1 class="text-center">買ったもの・買いたいものリスト</h1>
                            </div>
                        </div>
                    </div>
                    {{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}
                    @yield('content')
                </div>
            </main>
        </div>
    </body>
</html>