@foreach ($colors as $color) @endforeach
@foreach ($rules as $rule) @endforeach
@extends('style_admin')
<?php
$title =  "ویرایش قوانین و مقررات"  ;
$v = verta();
?>
 {{session(['name_panel'=>$title])}}
 {{session(['id'=>'6'])}}
@section('content')
<div class="row   ">
{{--start menu--}}
@include('admin.menu')
{{--end menu--}}
<div class="col-md-10   offset-md-2  afra-m-top-2 ">
    @if(session()->has('about'))
        <div class="alert alert-success ">
            ویرایش قوانین  با موفقیت انجام شد
        </div>
    @endif
        @if(session()->has('record'))
        <div class="alert alert-success ">
            ثبت قوانین  با موفقیت انجام شد
        </div>
    @endif
        @foreach ($rules as $rule)
            <div class="container ">
                <form method="POST" action="{{url('admin/rules_edit')}}" enctype="multipart/form-data">
                    @csrf
                    <input  name="date" type="hidden"  value="{{ $v->formatDate('Y/M/D') }}">
                    <input  name="time" type="hidden"  value="{{ $v->formatTime() }}">
                    <input  name="id" type="hidden"  value="{{ $rule->id }}">
                    <div class="row">
                        <div class="container ">
                            <div class="row justify-content-center ">
                                {{--start form--}}
                                {{--data general--}}
                                <div class="col-md-12 afra-padd-bottom card ">
                                    <div class="form-group row afra-p-top2">
                                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('عنوان '  ) }}</label>
                                            <div class="col-md-8">
                                                <textarea rows="2" id="title" type="text" class="form-control{{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" value="{{ $rule->title }}" >{{ $rule->title }}</textarea>
                                                @if ($errors->has('title '))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="description_one " class="col-md-2 col-form-label text-md-right">{{ __('متن ') }}</label>
                                            <div class="col-md-8">
                                                <textarea rows="15" id="description_one" type="text" class="form-control{{ $errors->has('description_one') ? 'is-invalid' : '' }}" name="description_one" value="{{ $rule->description_one }}" >{{ $rule->description_one }}</textarea>
                                                @if ($errors->has('description_one'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('description_one') }}</strong>
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
            <br>
        @endforeach
        <div class="container ">
            <form method="POST" action="{{url('admin/rules_record')}}" >
                @csrf

                <div class="row">
                    <div class="container ">
                        <div class="row justify-content-center ">
                            {{--start form--}}
                            {{--data general--}}
                            <div class="col-md-12 afra-padd-bottom card ">
                                <h4 class="p-3">اضافه کردن بخش جدید</h4>
                                <div class="form-group row afra-p-top2">
                                    <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('عنوان '  ) }}</label>
                                    <div class="col-md-8">
                                        <textarea rows="2" id="title" type="text" class="form-control{{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"  ></textarea>
                                        @if ($errors->has('title '))
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description_one " class="col-md-2 col-form-label text-md-right">{{ __('متن ') }}</label>
                                    <div class="col-md-8">
                                        <textarea rows="15" id="description_one" type="text" class="form-control{{ $errors->has('description_one') ? 'is-invalid' : '' }}" name="description_one"  ></textarea>
                                        @if ($errors->has('description_one'))
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('description_one') }}</strong>
                                                    </span>
                                        @endif
                                    </div>
                                </div>
                                {{--data login--}}
                                <div class="form-group row ">
                                    <div class="col-md-8 offset-md-2">
                                        <button type="submit" class="btn {{$color->button}} afra-white wrn-btn">
                                            {{ __('ثبت  اطلاعات') }}
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
</div>
</div>


@endsection
