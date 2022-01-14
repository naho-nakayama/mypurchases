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
            <title>ユーザー新規登録</title>
    
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
            <link href="{{ asset('css/register.css') }}" rel="stylesheet">
        </head>
        <body>
            <div id="app">  {{-- Vue.js用 Javascriptでエラー出ないため--}}
                <main>
                    <div class="container RegisterForm">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="balloon">
                                    <p>ネットで</p>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center registerTitle">
                            <div class="col-md-12">
                                <div class="title">
                                    <h1 class="text-center">買ったもの・買いたいものリスト</h1>
                                </div>
                            </div>
                        </div>

                        <div class="Register">
                            <h3 class="text-center text-white pt-5">Register form</h3>
                            
                            <div id="login-row" class="row justify-content-center align-items-center">
                                <div id="login-column" class="col-md-6">
                                    <form id="login-form" class="form" action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <h3 class="text-center text-info">{{ __('messages.User registration') }}</h3>
                                        
                                        <div class="form-group">
                                            <label for="name" class="text-info">{{ __('messages.Name') }}</label><br>
                                            <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required autofocus>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="email" class="text-info">{{ __('messages.E-Mail Address') }}</label><br>
                                            <input type="text" name="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required autofocus>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="password" class="text-info">{{ __('messages.Password') }}</label><br>
                                            <input type="text" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="password" class="text-info">{{ __('messages.Confirm Password') }}</label><br>
                                            <input type="text" name="password_confirmation" id="password_confirmation" class="form-control" required autocomplete="new-password">
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class ="text-left">
                                                <label for="remember-me" class="text-info"><span>{{ __('messages.Remember Me') }}</span> 
                                                <span><input id="remember-me" name="remember-me" type="checkbox" {{ old('remember') ? 'checked' : '' }}></span></label><br>
                                                <input type="submit" name="{{ __('messages.Login') }}" class="btn btn-info btn-md" value="{{ __('messages.Login') }}">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div id="register-link" class="text-right">
                                                <button type="submit" class="btn btn-outline-info ">{{ __('messages.Register') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                        <img class ="penguin" src ="https://i.gyazo.com/15c56b433afc7c34bfc9f6b01b8d60a2.png" alt="ペンギンの後ろ向きのイラスト" width=25%>
                    </div>
                </main>
            </div>
        </body>
    </html>
      