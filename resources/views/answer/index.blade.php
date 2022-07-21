@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style')
@php($title =  "پرسش و پاسخ   |   " . $general->title )
@php($v = verta())
@section('content')
    <div class="container-fluid">
    <div class="row   padding-foot afra-title-img " >
        <div class="col-lg-12  " >
            <h5 class="afra-p-t-15">
                <a href="/" class="afra-white"> <i class="fas fa-home"></i><b> صفحه اصلی /</b></a>
                <b >  پرسش و پاسخ </b>
            </h5>
        </div>
    </div>
    {{--  --}}
    <div class="row  " >
        <div class="col-lg-10   offset-md-1">
            <div class="afra-box" >
                @if(session()->has('delete'))
                    <div class="alert alert-success ">
                        پیام با موفقیت حذف شد .
                    </div>
                @endif
                @if(session()->has('answer_msg'))
                    <div class="alert alert-success ">
                        پاسخ شما با موفقیت ثبت شد .
                    </div>
                @endif
                @if(session()->has('inactive'))
                    <div class="alert alert-success ">
                        پیام با موفقیت غیر فعال شد .
                    </div>
                @endif
                @if(session()->has('active'))
                        <div class="alert alert-success ">
                            پیام برای نمایش عموم تایید شد .
                        </div>
                    @endif
                @if(session()->has('answer'))
                    <div class="alert alert-success ">
                        دوست عزیز پیام شما ثبت شد . پس از تایید پیام توسط مدیریت . در همین بخش پاسخ خود را دریافت نمایید .
                    </div>
                @endif
                @if(session()->has('answer_user'))
                    <div class="alert alert-success ">
پرسش ثبت شد.
                    </div>
                @endif
                @if(session()->has('check'))
                    <div class="alert alert-success ">
                        دوست عزیز پیام شما تکراری می باشد . لطفا برای دریافت پاسخ صبر نمایید .
                    </div>
                @endif

{{--create massage--}}
                @if (Route::has('login'))
                    @auth
                            <div class="form-group row">
                                <label for="subject" class="col-md-9 col-form-label text-md-right">{{ __(auth()->user()->name .' '. ' عزیز                                     در این بخش می توانید سوالات خود را راجب به هوشمند سازی جایگاه های سوخت ایران مطرح نمایید .') }}</label>
                                <div class="col-md-3">
                                    <button type="submit" class="btn {{$color->button}} afra-white wrn-btn" data-toggle="modal" data-target="#exampleModalLong">
                                        {{ __('ایجاد پیام ') }}
                                    </button>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">لطفا سوال خود را مطرح نمایید .</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="/user_answers" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row ">
                                                    <div class="col-md-12 ">
                                                        <input type="hidden" name="code" value="{{auth()->user()->code}}">
                                                        <input type="hidden" name="name" value="{{auth()->user()->name}}">
                                                        <input type="hidden" name="mobile" value="{{auth()->user()->mobile}}">
                                                        <input type="hidden" name="email" value="{{auth()->user()->email}}">
                                                        <div class="form-group row">
                                                            <label for="massage" class="col-md-3 col-form-label text-md-right">{{ __('متن پیام *') }}</label>
                                                            <div class="col-md-6">
                                                                <textarea id="massage" rows="5" class="form-control{{ $errors->has('massage') ? ' is-invalid' : '' }}" name="massage" value="{{ old('massage') }}" required ></textarea>
                                                                @if ($errors->has('massage'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>ثبت متن پیام الزامی می باشد</strong>
                                                                        </span>
                                                                @endif
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
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                    @else
                        <div class="form-group row">
                            <div class="col-md-10 ">
                        <h6 class="text-justify  afra-red-google ">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl">
                            <i class=" 	fas fa-hands-helping"></i>
                                راهنما
                            </button>
                        </h6>

                                <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">راهنمای پرسش و پاسخ </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                دوست عزیز : برای اعضای وب سایت فرزین توانش در این بخش دیگر نیازی به انتظار تایید پیام و وارد کردن نام و شماره تماس در بخش فرم نیست . اعضای گرامی به راحتی می توانند به صورت آنلاین در پرسش و پاسخ شرکت نمایند.

                                                <br> <br>برای راحتی در روند پرسش و پاسخ لطفا <a href="{{ url('/register') }}">عضو</a> وب سایت فرزین توانش شوید .</h6>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <button type="submit" class="btn {{$color->button}} afra-white wrn-btn" data-toggle="modal" data-target="#exampleModal">
                                    {{ __('ایجاد پیام ') }}
                                </button>
                            </div>
                        </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">لطفا سوال خود را مطرح نمایید .</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="/answers" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row ">
                                                    <div class="col-md-12 ">
                                                        <div class="form-group row">
                                                            <label for="name_family" class="col-md-3 col-form-label text-md-right">{{ __(' نام  *') }}</label>
                                                            <div class="col-md-6">
                                                                <input id="name_family" type="text" class="form-control{{ $errors->has('name_family') ? ' is-invalid' : '' }}" name="name_family" value="{{ old('name_family') }}" required >
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
                                                                <input id="mobile" type="number" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" required>
                                                                @if ($errors->has('mobile'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>تلفن همراه حتما باید 11 رقم باشد </strong>
                                                                        </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <h6> </h6>
{{--                                                        <div class="form-group row">--}}
{{--                                                            <label  class="col-md-12 col-form-label afra-red">{{ __('دوست عزیز در صورتیکه نام و موبایل شما ثبت شده است و کد دریافت نموده اید . دیگر نیازی به وارد کردن نام و موبایل نیست . تنها با کد کاربری سوال خود را مطرح نمایید .') }}</label>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="form-group row">--}}
{{--                                                            <label for="code" class="col-md-3 col-form-label text-md-right">{{ __('کد کاربری ') }}</label>--}}
{{--                                                            <div class="col-md-6">--}}
{{--                                                                <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}" >--}}
{{--                                                                @if ($errors->has('mobile'))--}}
{{--                                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                                            <strong>کد کاربری شامل حروف و اعداد می باشد . لطفا در وارد کردن کد دقت نمایید . </strong>--}}
{{--                                                                        </span>--}}
{{--                                                                @endif--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
                                                        <div class="form-group row">
                                                            <label for="massage" class="col-md-3 col-form-label text-md-right">{{ __('متن پیام *') }}</label>
                                                            <div class="col-md-6">
                                                                <textarea id="massage" rows="5" class="form-control{{ $errors->has('massage') ? ' is-invalid' : '' }}" name="massage" value="{{ old('massage') }}" required ></textarea>
                                                                @if ($errors->has('massage'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>ثبت متن پیام الزامی می باشد</strong>
                                                                        </span>
                                                                @endif
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
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endauth
                @endif

                    {{--answers--}}
                    @foreach ($answers as $answer)
                        @if (Route::has('login'))
                            @auth
                                @if(auth()->user()->code == "user948273" && $answer->code !="user948273")
                                    <div class="container2 darker">

                                        <span class="time-left"><form action="/admin/delete_msg" method="post"> @csrf<input type="hidden" name="id" value="{{$answer->id}}" /><button class="afra-btn-hidden" type="submit"><i class="fas fa-window-close afra-red"></i></button></form>   </span>
                                        @if($answer->active =="1")
                                            <span class="time-left"><form action="/admin/inactive_msg" method="post"> @csrf<input type="hidden" name="id" value="{{$answer->id}}" /><button class="afra-btn-hidden" type="submit"><i  class="fas fa-check-square   afra-green"></i></button></form>   </span>
                                        @else
                                            <span class="time-left"><form action="/admin/active_msg" method="post"> @csrf<input type="hidden" name="id" value="{{$answer->id}}" /><button class="afra-btn-hidden" type="submit"><i  class="fas fa-lock afra-red"></i></button></form>   </span>
                                        @endif
                                        <img src="users/default/profile-panel.png"  class="right" style="width:100%;">
                                        <p>{{$answer->name_family}}</p>
                                        <p>{{$answer->massage}}</p>
                                        <span class="time-right">{{$answer->date}}</span>
                                        <span class="time-left">
                                                 <form  method="post">
                                                   @csrf
                                                     <input type="hidden" name="name_ans" value="{{$answer->name_family}}" />
                                                     <input type="hidden" name="code" value="{{auth()->user()->code}}">
                                                     <button class="btn btn-info" type="button"  data-toggle="modal" data-target="#exampleModalCenter"
                                                             onClick="formget(this.form,'/answer_msg');" >پاسخ</button>
                                                 </form>
                                            </span>

                                    </div>
                                @elseif($answer->active == "1")
                                    <div class="container2 darker">
                                        <img src="users/default/profile-panel.png"  class="right" style="width:100%;">
                                        <p>{{$answer->name_family}}</p>
                                        <p>{{$answer->massage}}</p>
                                        <span class="time-right">{{$answer->date}}</span>
                                    </div>
                                @endif




{{--                    --}}
@else
                        @if(Route::has('logout') && $answer->active =="1" )
                                <div class="container2 darker">
                                    <img src="users/default/profile-panel.png"  class="right" style="width:100%;">
                                    <p>{{$answer->name_family}}</p>
                                    <p>{{$answer->massage}}</p>
                                    <span class="time-right">{{$answer->date}}</span>
                                </div>
                            @endif
                            @endauth
                        @endif
                    @endforeach

{{--                    پاسخ مدیر به کاربران--}}
                    @foreach ($answers as $answer)
                    @if($answer->answer !="")
                        <div class="container3 ">
                            <span class="time-left">پاسخ :
                                {{$answer->answer}}
                            </span>
                            <p>{{$answer->name_family}}</p>
                            <p>{{$answer->massage}}</p>
                            <span class="time-right">{{$answer->date}}</span>
                        </div>
                    @endif
                    @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection