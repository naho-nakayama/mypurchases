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
        <title>買ったものリスト編集画面</title>

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
    
    <body class ="boughtList_edit">
        <div id="app">
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
                            <ul class="navbar-nav ml-auto">
    
                            </ul>
                        </div>
                    </div>
            </nav>
            
            <main>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <h1 class="display-5">買ったものリストを編集</h1>
                        </div>
                    </div>
                    <br>
                    <div class ="row">
                        <div class="col-md-10 mx-auto">
                            <form action="{{ action('Admin\Bought_itemController@update') }}" method="post" enctype="multipart/form-data">
                                @if (count($errors) > 0)
                                    <ul class="errorMessages">
                                        @foreach($errors->all() as $e)
                                            <li>{{ $e }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <div class="form-group row">
                                    <label class="col-md-3" for="bought_date">✔ 日付は？</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control" name="date" value="{{ $bought_item_form->date->toDateString() }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="name">✔ ものの名前は？</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" value="{{ $bought_item_form->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="price">✔ 金額は？</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="price" value="{{ $bought_item_form->price }}">
                                    </div>
                                    <p>円</p>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="bought_sitename">✔ サイト名は？</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="sitename" value="{{ $bought_item_form->sitename }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="category">✔ もののカテゴリーは？</label>
                                    <div class="col-md-9">
                                        <div class="select_box">
                                            <select name="category_id" value="{{ $bought_item_form->category_id }}">
                                                
                                                @foreach($category as $value)
                                                    @php $selected = "";@endphp
                                                    @if($value->id == $bought_item_form->category_id)
                                                    @php $selected ="selected";@endphp
                                                    @endif
                                                <option value="{{ $value->id}}" {{$selected}}>{{$value->name}}</option>
                                                
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-3" for="image">✔ ものの画像</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image" id="inputFile">
                                                <label class="custom-file-label" for="inputFile" data-browse="参照">
                                                      @if(isset($bought_item_form->image_path))
                                                        {{ $bought_item_form->image_path }}
                                                      @else
                                                        {{ __('messages.Choose file') }}
                                                      @endif
                                                </label>
                                            </div>
                                             
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-secondary input-group-text" id="inputFileReset">取消</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-10">
                                        <input type="hidden" name="id" value="{{ $bought_item_form->id }}">
                                        {{ csrf_field() }}
                                        <input type="submit" class="btn btn-outline-info btn-lg" value="更新">
                                    </div>
                                </div>
                            </form>
                            <div class = "form-group row">
                                <div class ="col-md-9">
                                    
                                </div>
                                <div class ="col-md-3 text-right">
                                    <button type="button" class="btn btn-outline-secondary btn-lg" onclick="location.href='{{ action('Admin\Bought_itemController@bought_list') }}'">⬅︎リストに戻る</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
        <script type="text/javascript">
            window.onload = function(){
                bsCustomFileInput.init();
                console.log(1111);
                document.getElementById('inputFileReset').addEventListener('click',function(){
                    var elem = document.getElementById('inputFile');
                    console.log(2);
                    elem.value = '';
                    elem.dispatchEvent(new Event('change'));
                })
            }
        </script>
    </body>
</html>