@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach

@extends('style')
@php($title = " ثبت نام   | " . $general->title )

@section('content')
    <div class="container-fluid">
    <div class="  margin-top-bottom">
        @if(session()->has('register'))
            <div class="alert alert-success ">
ثبت نام با موفقیت انجام شد.            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header {{$color->title}}">{{ __('ثبت نام') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/register_user') }}" aria-label="{{ __('Register') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('  نام و نام خانوادگی *') }}</label>

                                <div class="col-md-7">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>ثبت نام و نام خانوادگی الزامی می باشد</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile" class="col-md-3 col-form-label text-md-right">{{ __('تلفن همراه *') }}</label>

                                <div class="col-md-7">
                                    <input id="mobile" type="number" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" required>

                                    @if ($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>ثبت تلفن همراه الزامی می باشد . تلفن همراه بصورت عدد وارد شود . و 11 رقم می باشد</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('ایمیل') }}</label>

                                <div class="col-md-7">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" >

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>فرمت ایمیل صیحح وارد شود</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('رمز عبور *') }}</label>

                                <div class="col-md-7">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>ثبت رمز عبور الزامی می باشد . رمز عبور حداقل 6 کاکتر می باشد . لطفا از رمز عبور امن استفاده کنید . که شامل حروف انگلیسی بزرگ و کوچک و اعداد و علائم مانند (# , $ < % . & , * ) می باشد .</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-3 col-form-label text-md-right">{{ __(' تکرار رمز عبور *') }}</label>

                                <div class="col-md-7">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-7 offset-md-3 ">
                                    <button type="submit" class="btn {{$color->button}} wrn-btn">
                                        {{ __('ثبت اطلاعات ') }}
                                    </button>
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
