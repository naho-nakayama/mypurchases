@extends('layouts.front')

@section('title', '買ったもの・買いたいものリスト')

@section('content')
            
           　 
           　 

        
     <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    
                        <form id="login-form" class="form" action="{{ route('login') }}" method="POST">
                            @csrf
                            <h3 class="text-center text-info">{{ __('messages.Login') }}</h3>
                            
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
                                <label for="remember-me" class="text-info"><span>{{ __('messages.Remember Me') }}</span> 
                                <span><input id="remember-me" name="remember-me" type="checkbox" {{ old('remember') ? 'checked' : '' }}></span></label><br>
                                <input type="submit" name="{{ __('messages.Login') }}" class="btn btn-info btn-md" value="{{ __('messages.Login') }}">
                            </div>
                            
                            <div id="register-link" class="text-right">
                                <button type="button" class="btn btn-outline-info " onclick="location.href='{{ action('BoughtforController@register_add') }}'">{{ __('messages.Register here') }}</button>
                            </div>
                        </form>
                    
                </div>
            </div>
            
            <div class="row cloud">
                
            </div>
            <div class=row>
                <div class="text-right">
                    <img src ="https://i.gyazo.com/8a7e7017351a66d1a29d7acb1f299b34.jpg" alt="ペンギンのイラスト" width=46%>    
                </div>
            </div>    
        </div>
    </div>
           
                
              

           　 
    
@endsection