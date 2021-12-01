@extends('layouts.front')
@section('title', 'ユーザー新規登録')
@section('content')
<div class="container">
    <div id="Register">
    <h3 class="text-center text-white pt-5">Register form</h3>
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
              
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h3 class="text-center text-info">ユーザー新規登録</h3>
                    
                    <div class="form-group">
                        <label for="name" class="text-info">{{ __('messages.Name') }}</label><br>
                        <input type="text" name="name" id="name" class="fform-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                        <label for="password-confirm" class="text-info">{{ __('messages.Confirm Password') }}</label><br>
                        <input type="text" name="password_confirmation" id="password-confirm" class="form-control" required autocomplete="new-password">
                    </div>
                    
                    
                    <br>
                     
                    
                    <div id="register-link" class="text-right">
                        <button type="submit" class="btn btn-outline-info ">{{ __('messages.Register') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>
            
@endsection
      
<!--    <div class="row justify-content-center">-->
<!--        <div class="col-md-8">-->
<!--            <div class="card">-->
<!--                <div class="card-header">{{ __('messages.Register') }}</div>-->

<!--                <div class="card-body">-->
<!--                    <form method="POST" action="{{ route('register') }}">-->
<!--                        @csrf-->

<!--                        <div class="form-group row">-->
<!--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.Name') }}</label>-->

<!--                            <div class="col-md-6">-->
<!--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>-->

<!--                                @error('name')-->
<!--                                    <span class="invalid-feedback" role="alert">-->
<!--                                        <strong>{{ $message }}</strong>-->
<!--                                    </span>-->
<!--                                @enderror-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        <div class="form-group row">-->
<!--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('messages.E-Mail Address') }}</label>-->

<!--                            <div class="col-md-6">-->
<!--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">-->

<!--                                @error('email')-->
<!--                                    <span class="invalid-feedback" role="alert">-->
<!--                                        <strong>{{ $message }}</strong>-->
<!--                                    </span>-->
<!--                                @enderror-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        <div class="form-group row">-->
<!--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('messages.Password') }}</label>-->

<!--                            <div class="col-md-6">-->
<!--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">-->

<!--                                @error('password')-->
<!--                                    <span class="invalid-feedback" role="alert">-->
<!--                                        <strong>{{ $message }}</strong>-->
<!--                                    </span>-->
<!--                                @enderror-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        <div class="form-group row">-->
<!--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('messages.Confirm Password') }}</label>-->

<!--                            <div class="col-md-6">-->
<!--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        <div class="form-group row mb-0">-->
<!--                            <div class="col-md-6 offset-md-4">-->
<!--                                <button type="submit" class="btn btn-primary">-->
<!--                                    {{ __('messages.Register') }}-->
<!--                                </button>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

