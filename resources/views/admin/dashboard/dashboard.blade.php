@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style_admin')
@php($title =  "ویرایش مشخصات")
@php($v = verta())

 {{session(['name_panel'=>$title])}}
 {{session(['id'=>'1'])}}
@section('content')
<div class="row   ">
{{--start menu--}}
@include('admin.menu')
{{--end menu--}}

<div class="col-md-10   offset-md-2 afra-m-top-2">
    <div class="container">

    @if(session()->has('general'))
                <div class="alert alert-success ">
                    ویرایش مشخصات با موفقیت انجام شد
                </div>
            @endif
            @if(session()->has('slider'))
                <div class="alert alert-success ">
                 آپلود بنر با موفقیت انجام شد
                </div>
            @endif
            @if(session()->has('footer'))
                <div class="alert alert-success ">
                    ویرایش فوتر  با موفقیت انجام شد
                </div>
            @endif
        @foreach ($generals as $general)
            <div class="container ">
                <form method="POST" action="{{url('admin/general_edit')}}" enctype="multipart/form-data">
                    @csrf
                    <input  name="date" type="hidden"  value="{{ $v->formatDate('Y/M/D') }}">
                    <input  name="time" type="hidden"  value="{{ $v->formatTime() }}">
                    <div class="row">
                        <div class="container">
                            <div class="row justify-content-center ">
                                {{--start form--}}
                                {{--data general--}}
                                <div class="col-md-12 afra-padd-bottom card ">
                                    <div class="form-group row afra-p-top2">
                                        <label for="title" class="col-md-2 col-form-label text-md-right">{{ __(' عنوان سایت ') }}</label>
                                            <div class="col-md-8">
                                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $general->title }}" >
                                                @if ($errors->has('title'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                                @endif
                                            </div>
                                   </div>
                                    <div class="form-group row">
                                            <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('توضیحات'  ) }}</label>
                                            <div class="col-md-8">
                                                <textarea rows="5" id="description" type="text" class="form-control{{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" value="{{ $general->description }}" >{{ $general->description }}</textarea>
                                                @if ($errors->has('description '))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="keywords_fa " class="col-md-2 col-form-label text-md-right">{{ __('کلید واژه های جستجوی فارسی') }}</label>
                                            <div class="col-md-8">
                                                <textarea rows="5" id="keywords_fa" type="text" class="form-control{{ $errors->has('keywords_fa') ? 'is-invalid' : '' }}" name="keywords_fa" value="{{ $general->keywords_fa }}" >{{ $general->keywords_fa }}</textarea>
                                                @if ($errors->has('keywords_fa'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('keywords_fa') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    <div class="form-group row">
                                            <label for="keywords_en" class="col-md-2 col-form-label text-md-right">{{ __('کلید واژه های جستجوی انگلیسی') }}</label>
                                            <div class="col-md-8">
                                                <textarea rows="5" id="keywords_en" type="text" class="form-control{{ $errors->has('keywords_en') ? ' is-invalid' : '' }}" name="keywords_en" value="{{ $general->keywords_en }}" >{{ $general->keywords_en }}</textarea>
                                                @if ($errors->has('keywords_en'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="company" class="col-md-2 col-form-label text-md-right">{{ __('نام شرکت') }}</label>
                                            <div class="col-md-3">
                                                <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}"
                                                       name="company" value="{{ $general->company }}" >
                                                @if ($errors->has('company'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <label for="company_code" class="col-md-2 col-form-label text-md-right">{{ __('کد شرکت') }}</label>
                                            <div class="col-md-3">
                                                <input id="company_code" type="text" class="form-control{{ $errors->has('company_code') ? ' is-invalid' : '' }}" name="company_code" value="{{ $general->company_code }}"  >
                                                @if ($errors->has('company_code'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    <div class="form-group row afra-p-top2">
                                        <label for="first_name" class="col-md-2 col-form-label text-md-right">{{ __(' نام ') }}</label>
                                        <div class="col-md-3">
                                            <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $general->first_name }}" >
                                            @if ($errors->has('first_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>ثبت نام شما الزامی می باشد</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <label for="first_name " class="col-md-2 col-form-label text-md-right">{{ __('نام و نام خانوادگی '  ) }}</label>
                                        <div class="col-md-3">
                                            <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ $general->last_name }}" >
                                            @if ($errors->has('last_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>ثبت نام خانوادگی الزامی می باشد.</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                        <div class="form-group row">
                                            <label for="address" class="col-md-2 col-form-label text-md-right">{{ __('آدرس اول ') }}</label>
                                            <div class="col-md-3">
                                                <textarea rows="3" id="address"  class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $general->address }}" >{{$general->address}}</textarea>
                                                @if ($errors->has('address'))
                                                    <span class="invalid-feedback" role="alert">
<strong>الزامی می باشد (لطفا آدرس محل سکونت را با دقت ثبت نمایید.)</strong>
</span>
                                                @endif
                                            </div>
                                            <label for="address_two" class="col-md-2 col-form-label text-md-right">{{ __('آدرس دوم') }}</label>
                                            <div class="col-md-3">
                                                <textarea rows="3" id="address_two"  class="form-control{{ $errors->has('address_two') ? ' is-invalid' : '' }}" name="address_two" value="{{ $general->address_two }}" >{{$general->address_two}}</textarea>
                                                @if ($errors->has('address_two'))
                                                    <span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('address_two') }}</strong>
</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="postal_code" class="col-md-2 col-form-label text-md-right">{{ __('کد پستی') }}</label>
                                            <div class="col-md-3">
                                                <input id="postal_code" type="number" class="form-control{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" name="postal_code" value="{{ $general->postal_code }}" >
                                                @if ($errors->has('postal_code'))
                                                    <span class="invalid-feedback" role="alert">
<strong>الزامی می باشد .(کد پستی حتما باید 11 رقم باشد . لطفا دقت نمایید.)</strong>
</span>
                                                @endif
                                            </div>
                                            <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('ایمیل ') }}</label>
                                            <div class="col-md-3">
                                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $general->email }}" >
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
<strong>ایمیل در سامانه نباید تکراری باشد . (اگر قبلا با این ایمیل ثبت نام نموده اید و نیاز به ویرایش دارید در بخش پنل مدیریتی خود اقدام به ویرایش ایمیل خود نمایید .)</strong>
</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="telephone" class="col-md-2 col-form-label text-md-right">{{ __('تلفن ثابت ' )  }}</label>
                                            <div class="col-md-3">
                                                <input id="telephone" type="number"  class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" value="{{ $general->telephone }}" >
                                                @if ($errors->has('telephone'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('telephone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('تلفن همراه ')  }}</label>
                                            <div class="col-md-3">
                                                <input id="mobile" type="number" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ $general->mobile }}"   >
                                                @if ($errors->has('mobile'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>ثبت شماره تلفن همراه الزامی می باشد . (شماره تلفن همراه نباید در سامانه تکراری باشد . اگر قبلا ثبت نام کرده اید در بخش پنل مدیریتی خود اقدام به ویرایش شماره همرا نمایید .)</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="img" class="col-md-9 col-form-label text-md-right">{{ __('انتخاب عکس لوگو (4*3) دقت شود فرمت تصوریر (jpg یا png یا jpeg ) باشد . و حجم فایل بیشتر از (124 مگابایت نباشد)') }}</label>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-8 offset-md-2">
                                                <input id="logo" type="file" class="form-control{{ $errors->has('logo') ? ' is-invalid' : '' }}" name="logo"
                                                       value="{{ $general->logo }}" >
                                                @if ($errors->has('logo'))
                                                    <span class="invalid-feedback" role="alert">
<strong>کاربر گرامی فرمت عکس پرسنلی شما باید با پسوند (png یا jpg یا jpeg باشد . لطفا نسبت به انتخاب تصویر دقت نمایید این تصویر در رزومه شما درج می شود .)</strong>
</span>
                                                @endif
                                            </div>
                                        </div>
                                    <div class="form-group row">
                                        <label for="favicon" class="col-md-9 col-form-label text-md-right">{{ __('انتخاب عکس فیورید آیکن آیکن کنار نوار عنوان (4*3) دقت شود فرمت تصوریر (jpg یا png یا jpeg ) باشد . و حجم فایل بیشتر از (124 مگابایت نباشد)') }}</label>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8 offset-md-2">
                                            <input id="favicon" type="file" class="form-control{{ $errors->has('favicon') ? ' is-invalid' : '' }}" name="favicon" value="{{ $general->favicon }}" >
                                            @if ($errors->has('favicon'))
                                                <span class="invalid-feedback" role="alert">
<strong>کاربر گرامی فرمت عکس پرسنلی شما باید با پسوند (png یا jpg یا jpeg باشد . لطفا نسبت به انتخاب تصویر دقت نمایید این تصویر در رزومه شما درج می شود .)</strong>
</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="img" class="col-md-9 col-form-label text-md-right">{{ __('انتخاب عکس شخصی (4*3) دقت شود فرمت تصوریر (jpg یا png یا jpeg ) باشد . و حجم فایل بیشتر از (124 مگابایت نباشد)') }}</label>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8 offset-md-2">
                                            <input id="img" type="file" class="form-control{{ $errors->has('img') ? ' is-invalid' : '' }}" name="img" value="{{ $general->img }}" >
                                            @if ($errors->has('img'))
                                                <span class="invalid-feedback" role="alert">
<strong>کاربر گرامی فرمت عکس پرسنلی شما باید با پسوند (png یا jpg یا jpeg باشد . لطفا نسبت به انتخاب تصویر دقت نمایید این تصویر در رزومه شما درج می شود .)</strong>
</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address_two" class="col-md-2 col-form-label text-md-right">{{ __('انتخاب نقشه گوگل مپ') }}</label>
                                        <div class="col-md-8">
                                            <textarea rows="5" id="maps"  class="form-control{{ $errors->has('maps') ? ' is-invalid' : '' }}"
                                                      name="maps" value="{{ $general->maps }}" >{{$general->maps}}</textarea>
                                            @if ($errors->has('maps'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    {{--data login--}}
                                    <div class="form-group row ">
                                        <div class="col-md-8 offset-md-2">
                                            <button type="submit" class="btn {{$color->button}} afra-white wrn-btn">
                                                {{ __('ویرایش اطلاعات') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{--end form--}}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach

           @foreach ($footers as $footer)
            <div class="container margin-t-b-2">
                <form method="POST" action="{{url('admin/footer_edit')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="container">
                            <div class="row justify-content-center ">
                                <div class="col-md-12 afra-padd-bottom card ">
                                    <div class="form-group row afra-p-top2">
                                        <label for="whats_app" class="col-md-2 col-form-label text-md-right">{{ __('لینک واتساپ') }}</label>
                                            <div class="col-md-8">
                                                <input id="whats_app" type="text" class="form-control{{ $errors->has('whats_app') ? ' is-invalid' : '' }}" name="whats_app" value="{{ $footer->whats_app }}" >
                                                @if ($errors->has('whats_app'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>
                                                        لطفا استاندارد های ثبت لینک را رعایت نمایید .
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                   </div>

                                        <div class="form-group row">
                                            <label for="telegram" class="col-md-2 col-form-label text-md-right">{{ __('لینک تلگرام') }}</label>
                                            <div class="col-md-8">
                                                <input id="telegram" type="text" class="form-control{{ $errors->has('telegram') ? ' is-invalid' : '' }}"
                                                       name="telegram" value="{{ $footer->telegram }}" >
                                                @if ($errors->has('telegram'))
                                                    <span class="invalid-feedback" role="alert">
                                                         <strong>
                                                        لطفا استاندارد های ثبت لینک را رعایت نمایید .
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                            <label for="inst_gram" class="col-md-2 col-form-label text-md-right">{{ __('لینک اینستا گرام') }}</label>
                                            <div class="col-md-8">
                                                <input id="inst_gram" type="text" class="form-control{{ $errors->has('inst_gram') ? ' is-invalid' : '' }}" name="inst_gram" value="{{ $footer->inst_gram }}"  >
                                                @if ($errors->has('inst_gram'))
                                                    <span class="invalid-feedback" role="alert">
                                                         <strong>
                                                        لطفا استاندارد های ثبت لینک را رعایت نمایید .
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="facebook" class="col-md-2 col-form-label text-md-right">{{ __('لینک فیسبوک') }}</label>
                                            <div class="col-md-8">
                                                <input id="facebook" type="text" class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}" name="facebook" value="{{ $footer->facebook }}" >
                                                @if ($errors->has('facebook'))
                                                    <span class="invalid-feedback" role="alert">
                                                         <strong>
                                                        لطفا استاندارد های ثبت لینک را رعایت نمایید .
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                            <label for="twitter" class="col-md-2 col-form-label text-md-right">{{ __('لینک تویتر ') }}</label>
                                            <div class="col-md-8">
                                                <input id="twitter" type="text" class="form-control{{ $errors->has('twitter') ? ' is-invalid' : '' }}" name="twitter" value="{{ $footer->twitter }}" >
                                                @if ($errors->has('twitter'))
                                                    <span class="invalid-feedback" role="alert">
                                                         <strong>
                                                        لطفا استاندارد های ثبت لینک را رعایت نمایید .
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="android" class="col-md-2 col-form-label text-md-right">{{ __('لینک دانلود اپلیکیشن اندروید' )  }}</label>
                                            <div class="col-md-8">
                                                <input id="android" type="text"  class="form-control{{ $errors->has('android') ? ' is-invalid' : '' }}" name="android" value="{{ $footer->android }}" >
                                                @if ($errors->has('android'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>
                                                        لطفا استاندارد های ثبت لینک را رعایت نمایید .
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                            <label for="ios" class="col-md-2 col-form-label text-md-right">{{ __('لینک دانلود IOS')  }}</label>
                                            <div class="col-md-8">
                                                <input id="ios" type="text" class="form-control{{ $errors->has('ios') ? ' is-invalid' : '' }}" name="ios" value="{{ $footer->ios }}"   >
                                                @if ($errors->has('ios'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>
                                                        لطفا استاندارد های ثبت لینک را رعایت نمایید .
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>



                                    <div class="form-group row ">
                                        <div class="col-md-8 offset-md-2">
                                            <button type="submit" class="btn {{$color->button}} afra-white wrn-btn">
                                                {{ __('ویرایش اطلاعات فوتر') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{--end form--}}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach

           @foreach ($sliders as $slider)
            <div class="container margin-t-b-2">
                <form method="POST" action="{{url('admin/slider_edit')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-12 afra-padd-bottom card ">

                        <h6 for="slider_img" class="col-md-6 margin-t-b-2 col-form-label text-md-right">{{ __('آپلود تصویر  اول اسلایدر  صفحه اصلی  (سایز 1500*400 و ریزولوشن 72 فرمت jpg)   ') }}</h6>
                                <div class="form-group row">
                                    <div class="col-md-8 offset-md-2">
                                        <input id="slider_img" type="file" class="form-control{{ $errors->has('slider_img') ? ' is-invalid' : '' }}" name="slider_img" />
                                        @if ($errors->has('slider_img'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>لطفا استاندارد های آپلود بنر را رعایت نمایید .</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>



                            <h6 for="slider_img_one" class="col-md-6 margin-t-b-2 col-form-label text-md-right">{{ __('آپلود تصویر دوم اسلایدر  صفحه اصلی  (سایز 1500*400 و ریزولوشن 72 فرمت jpg)   ') }}</h6>
                            <div class="form-group row">
                                <div class="col-md-8 offset-md-2">
                                    <input id="slider_img_one" type="file" class="form-control{{ $errors->has('slider_img_one') ? ' is-invalid' : '' }}" name="slider_img_one"/>
                                    @if ($errors->has('slider_img_one'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>لطفا استاندارد های آپلود بنر را رعایت نمایید .</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <h6 for="slider_img_two" class="col-md-6 margin-t-b-2 col-form-label text-md-right">{{ __('آپلود تصویر سوم اسلایدر  صفحه اصلی  (سایز 1500*400 و ریزولوشن 72 فرمت jpg)   ') }}</h6>
                            <div class="form-group row">
                                <div class="col-md-8 offset-md-2">
                                    <input id="slider_img_two" type="file" class="form-control{{ $errors->has('slider_img_two') ? ' is-invalid' : '' }}" name="slider_img_two"/>
                                    @if ($errors->has('slider_img_two'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>لطفا استاندارد های آپلود بنر را رعایت نمایید .</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <h6 for="banner" class="col-md-6 margin-t-b-2 col-form-label text-md-right">{{ __('آپلود بنر در  صفحه اصلی  (سایز 1500*400 و ریزولوشن 72 فرمت jpg)   ') }}</h6>
                            <div class="form-group row">
                                <div class="col-md-8 offset-md-2">
                                    <input id="banner" type="file" class="form-control{{ $errors->has('banner') ? ' is-invalid' : '' }}" name="banner"/>
                                    @if ($errors->has('banner'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>لطفا استاندارد های آپلود بنر را رعایت نمایید .</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>


                        <div class="form-group row ">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn {{$color->button}} afra-white wrn-btn">
                                    {{ __(' آپلود تصاویر اسلایدر و بنر') }}
                                </button>
                            </div>
                        </div>
                        </div>
                                {{--end form--}}
                            </div>
                </form>
            </div>
        @endforeach


</div>
</div>


</div>

@endsection
