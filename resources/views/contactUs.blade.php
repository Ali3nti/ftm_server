@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@foreach ($footers as $footer) @endforeach
@extends('style')
<?php
$title =  "تماس  با ما |" .$general->title ;
$v = verta();
?>
@section('content')
    <div class="container-fluid">
    <div class="row {{$color->title}}  padding-foot afra-title-img" >
        <div class="col-lg-12  " >
            <h5 class="afra-p-top5">
                <a href="/" class="afra-white"> <i class="fas fa-home"></i> صفحه اصلی /</a>   <b >    تماس  با ما </b>
            </h5>
        </div>
    </div>
    {{--  --}}
    <div class="row  " >
        <div class="col-lg-10   offset-md-1">
            <div class="afra-box-2" >
                <div class="row  " >
                    <div class="col-lg-9 ">
                        <h6 class="line-footer" >
                            <i class="fas fa-mobile-alt icon-footer {{$color->icon}}" ></i>    تلفن :  {{ $general->telephone}}              <br>
                            <i class="far fa-envelope icon-footer {{$color->icon}}" ></i>  ایمیل  :    {{ $general->email}}   <br>                                         <br>
                        </h6>
                    </div>
                    <div class="col-lg-3   ">
                        <a href="{{$footer->inst_gram}}" target="_blank"><i class="fab fa-instagram" id="link-dark"></i></a>
                        <a href="{{$footer->whats_app}}" target="_blank"><i class="fab fa-whatsapp" id="link-dark"></i></a>
                        <a href="{{$footer->telegram}}" target="_blank"><i class="fab fa-telegram" id="link-dark"></i></a>
                        <a href="{{$footer->facebook}}" target="_blank"><i class="fab fa-facebook-square" id="link-dark"></i></a>
                        <a href="{{$footer->twitter}}" target="_blank"><i class="fab fa-twitter" id="link-dark"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    {{--  --}}
    <div class="row  " >
        <div class="col-lg-10   offset-md-1">
            <div class="afra-box-3" >
                <div class="row  " >
                    @if(session()->has('check'))
                        <div class="alert alert-success ">
                            کاربر گرامی قبلا پیامی با نام شما با موضوعی مشابه و متن پیام مشترک ثبت شده است  .  لطفا از تکرار پیام خوداری نمایید ,  به زودی پاسخ به ایمیل و یا شماره موبایل شما ارسال می گردد .               با تشکر
                        </div>
                    @endif
                    @if(session()->has('answer'))
                        <div class="alert alert-success ">
                            کاربر گرامی پیام شما با موفقیت ثبت شد . پاسخ به ایمیل و یا به صورت پیامک ارسال می گردد .               با تشکر
                        </div>
                    @endif
                    <div class="col-lg-12  ">
                        <h6  class="afra-line-height">
                            برای ارتباط با {{$general->company}} می‌توانید فرم زیر را تکمیل و ارسال نمایید. همکاران بخش مربوطه با شما در ارتباط خواهند بود. در صورت نیاز می‌توانید از طریق تلفن‌های تماس نیز امور خود را پیگیری نمایید .</h6>
                        <section class="search-sec" >
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">

                                <form method="POST" action="/contact" enctype="multipart/form-data">
                                    @csrf
                                    <input  name="date" type="hidden"  value="{{ $v->formatDate('Y/M/D') }}">
                                    <input  name="time" type="hidden"  value="{{ $v->formatTime() }}">
                                    <div class="row ">
                                        <div class="container margin-top-bottom">
                                            <div class="row justify-content-center">
                                                {{--start form--}}
                                                {{--data general--}}
                                                <div class="col-md-12 ">
                                                    <div class="form-group row">
                                                        <label for="name_family" class="col-md-3 col-form-label text-md-right">{{ __(' نام و نام خانوادگی *') }}</label>
                                                        <div class="col-md-9">
                                                            <input id="name_family" type="text" class="form-control{{ $errors->has('name_family') ? ' is-invalid' : '' }}" name="name_family" value="{{ old('name_family') }}" required autofocus>
                                                            @if ($errors->has('name_family'))
                                                                <span class="invalid-feedback" role="alert">
                     <strong>ثبت نام شما الزامی می باشد</strong>
                       </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="mobile" class="col-md-3 col-form-label text-md-right">{{ __('شماره تماس ') }}</label>
                                                        <div class="col-md-9">
                                                            <input id="mobile" type="number" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" >
                                                            @if ($errors->has('mobile'))
                                                                <span class="invalid-feedback" role="alert">
                     <strong>تلفن همراه حتما باید 11 رقم باشد </strong>
                       </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('ایمیل') }}</label>
                                                        <div class="col-md-9">
                                                            <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" >
                                                            @if ($errors->has('email'))
                                                                <span class="invalid-feedback" role="alert">
                     <strong>لطفا فرمت صحیح ایمیل را رعایت کنید .
                     مانند نمونه : samanekar88@gmail.com
                     </strong>
                       </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="subject" class="col-md-3 col-form-label text-md-right">{{ __('موضوع پیام *') }}</label>
                                                        <div class="col-md-9">
                                                            <input id="subject" type="text" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" value="{{ old('subject') }}" required autofocus>
                                                            @if ($errors->has('subject'))
                                                                <span class="invalid-feedback" role="alert">
                     <strong>برای تسریع در روند پاسخگویی وارد کردن موضوع الزامی می باشد .</strong>
                       </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="massage" class="col-md-3 col-form-label text-md-right">{{ __('متن پیام *') }}</label>
                                                        <div class="col-md-9">
                                                            <textarea id="massage" rows="5" class="form-control{{ $errors->has('massage') ? ' is-invalid' : '' }}" name="massage" value="{{ old('massage') }}" required autofocus></textarea>
                                                            @if ($errors->has('massage'))
                                                                <span class="invalid-feedback" role="alert">
                     <strong>ثبت متن پیام الزامی می باشد</strong>
                       </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="form-check offset-md-3  afra-pading-right">
                                                            <input class="form-check-input" type="checkbox" name="publish" id="publish" {{ old('publish') ? 'publish' : '' }}>
                                                            <label class="form-check-label" for="publish">
                                                                {{ __('آیا راضی به نشر پیام خود هستید ؟ ') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row ">
                                                        <div class="col-md-9 offset-md-3">
                                                            <button type="submit" class="btn {{$color->button}} afra-gery5-b wrn-btn">
                                                                {{ __('ارسال پیام ') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                                <div class="col-md-6">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m27!1m12!1m3!1d54617.712493547806!2d52.600335349716914!3d31.176178059948462!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m12!3e6!4m4!1s0x3fb001b22b5492b7%3A0xfac5bfdcffa4b724!3m2!1d31.1761828!2d52.635354899999996!4m5!1s0x3fb001b22b5492b7%3A0xfac5bfdcffa4b724!2z2KfYs9iq2KfZhiDZgdin2LHYs9iMINmF2YfYsdiz2KfYr9iMINin24zYsdin2YYg2Iwg2KfYs9iq2KfZhiDZgdin2LHYsyDYjCDYtNmH2LHYs9iq2KfZhiDYotio2KfYr9mHINiMINmF24zYr9in2YYg2KLYstin2K_bjCDYrNmG2Kgg2K7ZiNin2Kjar9in2Ycg2LrYr9uM2LEg2Iwg2YXYsdqp2LIg2LHYtNivINmI2KfYrdivINmH2KfbjCDZgdmG2KfZiNix24wg2KLYqNin2K_ZhyDYjNiMINi02LHaqdiqINmB2LHYstuM2YYg2KrZiNin2YbYtNiM2Iwg2YfZiNi02YXZhtivINiz2KfYstuMINis2KfbjNqv2KfZhyDYs9mI2K7YqtiMIElyYW4!3m2!1d31.1761828!2d52.635354899999996!5e0!3m2!1sen!2sus!4v1560143818996!5m2!1sen!2sus" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                            </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{--  --}}

@endsection
