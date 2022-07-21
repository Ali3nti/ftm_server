@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach

@extends('style')
<?php $title = "ورود  | " .$general->title ;   ; ?>

@section('content')
        <div class="container-fluid">
                <div class=" margin-top-bottom">
                        <div class="row justify-content-center">
                                <div class="col-md-6">
                                <div class="card">
                                        <div class="card-header {{$color->title}}">{{ __('ورود به پنل کاربری') }}</div>

                                        <div class="card-body">
                                                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                                        @csrf

                                                        <div class="form-group row">
                                                                <label for="mobile" class="col-sm-3 col-form-label text-md-right">{{ __('شماره تلفن همراه') }}</label>

                                                                <div class="col-md-7">
                                                                        <input id="mobile" type="number" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" required autofocus>

                                                                        @if ($errors->has('mobile'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                <strong>لطفا از صحت تلفن همراه خود اطمینان پیدا کنید .</strong>
                                                                        </span>
                                                                        @endif
                                                                </div>
                                                        </div>

                                                        <div class="form-group row">
                                                                <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('رمز عبور') }}</label>

                                                                <div class="col-md-7">
                                                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                                        @if ($errors->has('password'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                <strong>نام کاربری و رمز عبور صحیح نمی باشد</strong>
                                                                        </span>
                                                                        @endif
                                                                </div>
                                                        </div>

                                                        <div class="form-group row">
                                                                <div class="col-md-7 offset-md-3">
                                                                        <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                                                <label class="form-check-label" for="remember">
                                                                                        {{ __('مرا به خاطر بسپار') }}
                                                                                </label>
                                                                        </div>
                                                                </div>
                                                        </div>

                                                        <div class="form-group row mb-0">
                                                                <div class="col-md-7 offset-md-3">
                                                                        <button type="submit" class="btn wrn-btn {{$color->button}}">
                                                                                {{ __('ورود به پنل') }}
                                                                        </button>
                                                                    <div class="afra-padd-bottom"></div>
                                                                        <a class="btn btn-link  afra-green" href="{{ url('/register') }}">
                                                                                {{ __('ثبت نام در فرزین توانش مهرساد') }}
                                                                        </a>
                                                                        <a class="btn btn-link  afra-red" href="{{ route('password.request') }}">
                                                                                {{ __('آیا رمز عبورتان را فراموش کرده اید ؟') }}
                                                                        </a>

                                                                </div>
                                                        </div>
                                                </form>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        </div>
@endsection
