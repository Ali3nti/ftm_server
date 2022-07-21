@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style')
<?php
$title =  "ثبت شکایات | " .$general->title ;
$v = verta();
?>
@section('content')
    <div class="container-fluid">
    <div class="row {{$color->title}}  padding-foot afra-title-img" >
        <div class="col-lg-12  " >
            <h5 class="afra-p-top5">
                <a href="/" class="afra-white"> <i class="fas fa-home"></i> صفحه اصلی /</a>   <b >    ثبت شکایات  </b>
            </h5>
        </div>
    </div>
{{--  --}}
<div class="row  " >
<div class="col-lg-10   offset-md-1">
<div class="afra-box" >
<div class="row " >
@if(session()->has('check'))
        <div class="alert alert-success center">
           کاربر گرامی قبلا پیامی با نام شما با موضوعی مشابه و متن پیام مشترک ثبت شده است  .  لطفا از تکرار پیام خوداری نمایید ,  به زودی پاسخ به ایمیل و یا شماره موبایل شما ارسال می گردد .               با تشکر
        </div>
@endif
@if(session()->has('answer'))
        <div class="alert alert-success center">
           کاربر گرامی پیام شما با موفقیت ثبت شد . پاسخ به ایمیل و یا به صورت پیامک ارسال می گردد .               با تشکر
        </div>
@endif
<div class="col-lg-10 offset-md-1 ">
    <h4 class="afra-title {{$color->main_one}}">فرم ثبت شکایت  </h4>

<h6  class="afra-line-height">
            برای ثبت شکایات در {{$general->company}}  میتوانید فرم زیر را تکمیل نمایید. همکاران بخش مربوطه با شما در ارتباط خواهند بود . درصورت نیاز می توانید از طریق تلفن های تماس نیز شکایات خود را پیگیری نمایید.
</h6>
<section class="search-sec" >
    <div class="container">
        <form method="POST" action="/complaint_send" enctype="multipart/form-data">
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
                <div class="col-md-6">
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
                <div class="col-md-6">
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
                <div class="col-md-6">
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
              <label for="subject" class="col-md-3 col-form-label text-md-right">{{ __('موضوع شکایت *') }}</label>
                <div class="col-md-6">
                <input id="subject" type="text" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" value="{{ old('subject') }}" required autofocus>
                  @if ($errors->has('subject'))
                  <span class="invalid-feedback" role="alert">
                     <strong>برای تسریع در روند پاسخگویی وارد کردن موضوع الزامی می باشد .</strong>
                       </span>
                       @endif
                       </div>
            </div>
              <div class="form-group row">
              <label for="massage" class="col-md-3 col-form-label text-md-right">{{ __('متن شکایت *') }}</label>
                <div class="col-md-6">
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
            <div class="col-md-6 offset-md-3">
            <button type="submit" class="btn {{$color->button}} afra-white wrn-btn">
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
</section>

</div>
</div>
</div>
</div>
</div>
</div>
{{--  --}}
@endsection