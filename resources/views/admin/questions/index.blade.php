@foreach ($colors as $color) @endforeach

@extends('style_admin')
@php($title =  "مدیریت سوالات متداول ")

 {{session(['name_panel'=>$title])}}
 {{session(['id'=>'9'])}}
@section('content')
<div class="row   ">
{{--start menu--}}
@include('admin.menu')
{{--end menu--}}
<div class="col-md-10   offset-md-2  afra-m-top-2 ">
    <div class="container afra-padd-bottom">
        <div class="row justify-content-center ">
            <div class="col-md-12 afra-p-t-25  card ">
    @if(session()->has('question'))
        <div class="alert alert-success ">
            ویرایش سوالات متداول   با موفقیت انجام شد
        </div>
    @endif
        @if(session()->has('record'))
        <div class="alert alert-success ">
            ثبت سوالات متداول   با موفقیت انجام شد
        </div>
    @endif

    @if(session()->has('delete'))
    <div class="alert alert-success ">
            حذف   با موفقیت انجام شد
    </div>
    @endif

                @if(session()->has('active'))
                <div class="alert alert-success ">
                    سوال مورد نظر فعال  شد .
                </div>
                @endif
                @if(session()->has('inactive'))
                <div class="alert alert-success ">
                    سوال مورد نظر غیر فعال شد .
                </div>
                @endif


        <form method="POST" action="{{url('admin/question_record')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="container ">
                    <div class="row justify-content-center ">
                        <div class="col-md-12 afra-padd-bottom  ">
                            <div class="col-md-6 offset-md-1 afra-p-top2" >  <h4 > تعریف سوالات متداول   </h4></div>
                                <div class="form-group row afra-p-top2">
                                    <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('طرح سوال *'  ) }}</label>
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
                                    <label for="description_one " class="col-md-2 col-form-label text-md-right">{{ __('پاسخ *') }}</label>
                                    <div class="col-md-8">
                                        <textarea rows="5" id="description_one" type="text" class="form-control{{ $errors->has('description_one') ? 'is-invalid' : '' }}" name="description_one"  ></textarea>
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
                <div class="container afra-p-b-20">
            <div class="row">
                <div class="col-md-12 card  afra-p-b-20">

                    <div class="row  {{$color->title}}" >
                        <div class="col-md-1 d-none d-sm-block    border">وضعیت</div>
                        <div class="col-md-3 d-none d-sm-block  border">سوال </div>
                        <div class="col-md-6 d-none d-sm-block border ">پاسخ  </div>
                        <div class="col-md-1 d-none d-sm-block border ">ویرایش </div>
                        <div class="col-md-1 d-none d-sm-block border ">حذف  </div>
                    </div>
                    @foreach ($questions as $question)
                    <div class="row  " >
                        <div class="col-md-1 d-none d-sm-block border">
                            @if($question->active == "1")
                            <form method="post" action="/admin/inactiveQuestion" >
                                @csrf
                                <input  name="id" type="hidden"  value="{{$question->id}}">
                                <button type="submit"  class="btn afra-btn-hide">
                                    <i class="fas fa-check afra-f-20 p-3 text-success"></i>
                                </button>
                            </form>
                            @else
                            <form method="post" action="/admin/activeQuestion" >
                                @csrf
                                <input  name="id" type="hidden"  value="{{$question->id}}">
                                <button type="submit"  class="btn afra-btn-hide">
                                    <i class="fas fa-check afra-f-20 p-3 text-danger"></i>
                                </button>
                            </form>

                            @endif
                        </div>
                        <div class="col-md-3 d-none d-sm-block border">{{$question->title}}</div>
                        <div class="col-md-6 d-none d-sm-block border">{{$question->description_one}}</div>
                        <div class="col-md-1 d-none d-sm-block border center">
                            <button type="button"     class="btn {{$color->main_three}} afra-white" data-toggle="collapse" href="#collapseExample{{$question->id}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$question->id}}">
                                <i class="fas fa-edit  afra-f-20 p-3 text-success"></i>
                            </button>

                        </div>

                        <div class="col-md-1 d-none d-sm-block border center">
                            <form method="post" action="/admin/deleteQuestion" >
                                @csrf
                                <input  name="id" type="hidden"  value="{{$question->id}}">
                                <button type="submit"  class="btn afra-btn-hide">
                                    <i class="fas fa-window-close afra-f-20 p-3 text-danger"></i>
                                </button>
                            </form>

                        </div>
                        <div class="collapse   afra-w-100" id="collapseExample{{$question->id}}">
                            <div class="card card-body right">
                                <form method="post" action="/admin/editQuestion" >
                                    @csrf
                                    <input  name="id" type="hidden"  value="{{$question->id}}">
                                    <div class="form-group row ">
                                        <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('سوال'  ) }}</label>
                                        <div class="col-md-8">
                                            <input  id="title" type="text" class="form-control{{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"    value="{{$question->title}}" />
                                            @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description_one" class="col-md-2 col-form-label text-md-right">{{ __('پاسخ'  ) }}</label>
                                        <div class="col-md-8">
                                            <textarea rows="2" id="description_one" type="text" class="form-control{{ $errors->has('description_one') ? 'is-invalid' : '' }}" name="description_one"  >{{ $question->description_one }}</textarea>
                                            @if ($errors->has('description_one '))
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-md-6 offset-md-4">
                                    <button type="submit"  class="btn {{$color->button}} afra-white ">
                                     ویرایش سوال و پاسخ
                                    </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>

                    @endforeach
                </div>
            </div>
            </div>
            </div>
</div>
</div>
</div>
</div>


@endsection
