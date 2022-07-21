@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style')
@php($title =  "نظر سنجی   | " .$general->title )
@section('content')
    <div class="container-fluid">
        <div class="row {{$color->title}}  padding-foot afra-title-img" >
            <div class="col-md-12  " >
                <h5 class="afra-p-top5">
                    <a href="/" class="afra-white"> <i class="fas fa-home"></i> صفحه اصلی /</a>   <b >    نظر سنجی  </b>
                </h5>
            </div>
        </div>

    {{--  --}}
        <div class="container">
            @if(session()->has('answer'))
            <div class="alert alert-success ">
             دوست عزیز نظر شما با موفقیت ثبت شد . با تشکر از همکاری شما در جهت بهبود فعالیت های شرکت .
            </div>
            @endif
            <form method="POST" action="/answers" enctype="multipart/form-data">
                @csrf
            <div  class="row   afra-p-t-b   afra-white"   >
@php($i= 1 )
                @foreach ($surveys as $survey)

                <div class="col-md-12  " >
                <h5 class="afra-green-google">
                    {{$i}} -    {{$survey->question}}

                    <b class="afra-green-google" >؟</b>
                    <input type="hidden" value="{{$survey->question}}" name="question{{$i}}">
                </h5>
                    <div class="form-group row">
                        <div class="col-md-7 ">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer{{$i}}" id="answer{{$i}}"  value="{{$survey->answer_one}}">

                                <label class="form-check-label {{$color->pen}}" >
                                    {{$survey->answer_one}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-7 ">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer{{$i}}" id="answer{{$i}}"  value="{{$survey->answer_two}}">

                                <label class="form-check-label {{$color->pen}}"  >
                                    {{$survey->answer_two}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-7 ">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer{{$i}}" id="answer{{$i}}"  value="{{$survey->answer_three}}">

                                <label class="form-check-label {{$color->pen}}" >
                                    {{$survey->answer_three}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-7 ">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer{{$i}}" id="answer{{$i}}"  value="{{$survey->answer_four}}">

                                <label class="form-check-label {{$color->pen}}" >
                                    {{$survey->answer_four}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
@php($i++)
                @endforeach

            </div>
                @if (Route::has('login'))
                    @auth
        <input type="hidden" name="name_family"  value="{{auth()->user()->name}}">
        <input type="hidden" name="mobile"  value="{{auth()->user()->mobile}}">
                <div class="form-group row ">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn {{$color->button}} afra-white wrn-btn">
                            {{ __('ثبت نظر ') }}
                        </button>
                    </div>
                </div>
                        @else
                        <div class="row ">
                            <div class="col-md-12 ">
                                <div class="form-group row">
                                    <label for="name_family" class="col-md-3 col-form-label text-md-right">{{ __(' نام و نام خانوادگی  ') }}</label>
                                    <div class="col-md-6">
                                        <input id="name_family" type="text" class="form-control{{ $errors->has('name_family') ? ' is-invalid' : '' }}" name="name_family" value="{{ old('name_family') }}"  >
                                        @if ($errors->has('name_family'))
                                            <span class="invalid-feedback" role="alert">
                            <strong>ثبت نام شما الزامی می باشد</strong>
                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mobile" class="col-md-3 col-form-label text-md-right">{{ __('شماره تماس  ') }}</label>
                                    <div class="col-md-6">
                                        <input id="mobile" type="number" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" >
                                        @if ($errors->has('mobile'))
                                            <span class="invalid-feedback" role="alert">
                            <strong>تلفن همراه حتما باید 11 رقم باشد </strong>
                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-md-6 offset-md-3">
                                        <button type="submit" class="btn {{$color->button}} afra-white wrn-btn">
                                            {{ __('ثبت نظر ') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endauth
                @endif
            </form>
        </div>

<!--    -->
    </div>


@endsection
