@foreach ($colors as $color) @endforeach

@extends('style_admin')
<?php
$title =  "مدیریت نظرسنجی "  ;
$v = verta();
?>
 {{session(['name_panel'=>$title])}}
 {{session(['id'=>'10'])}}
@section('content')
<div class="row   ">
{{--start menu--}}
@include('admin.menu')
{{--end menu--}}
<div class="col-md-10   offset-md-2  afra-m-top-2 ">
    <div class="container afra-padd-bottom">
        <div class="row justify-content-center ">
            <div class="col-md-12 afra-p-t-25  card ">
                @if(session()->has('delete'))
                    <div class="alert alert-success ">
                        سوال مورد نظر حذف شد .
                    </div>
                @endif
    @if(session()->has('edit'))
        <div class="alert alert-success ">
            ویرایش نظرسنجی   با موفقیت انجام شد
        </div>
    @endif
        @if(session()->has('record'))
        <div class="alert alert-success ">
            ثبت سوال نظرسنجی   با موفقیت انجام شد
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
        <div class="container afra-p-b-20">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item ">
                    <a class="nav-link active p-2 {{$color->pen}} border" id="menu-one-tab" data-toggle="pill" href="#menu-one" role="tab" aria-controls="pills-home" aria-selected="true"> <i class="fas fa-edit afra-green"></i>  طرح سوال نظر سنجی </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link p-2 {{$color->pen}} border" id="menu-two-tab" data-toggle="pill" href="#menu-two" role="tab" aria-controls="pills-profile" aria-selected="false"> <i class="fas fa-user afra-green"></i>  مشاهده شرکت کنندگان </a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="menu-one" role="tabpanel" aria-labelledby="menu-one-tab">
                    <form method="POST" action="{{url('admin/surveyRecord')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="container ">
                                <div class="row justify-content-center ">
                                    <div class="col-md-12 afra-padd-bottom  ">
                                        <div class="col-md-6 offset-md-1 afra-p-top2" >  <h4 > تعریف    سوال و پاسخ نظرسنجی</h4></div>
                                        <div class="form-group row afra-p-top2">
                                            <label for="question" class="col-md-2 col-form-label text-md-right">{{ __('سوال *'  ) }}</label>
                                            <div class="col-md-8">
                                                <input  id="question" type="text" class="form-control{{ $errors->has('question') ? 'is-invalid' : '' }}" name="question"   required >
                                                @if ($errors->has('question'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row afra-p-top2">
                                            <label for="answer_one" class="col-md-2 col-form-label text-md-right">{{ __('جواب یک *'  ) }}</label>
                                            <div class="col-md-8">
                                                <input  id="answer_one" type="text" class="form-control{{ $errors->has('answer_one') ? 'is-invalid' : '' }}" name="answer_one"   required >
                                                @if ($errors->has('answer_one'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row afra-p-top2">
                                            <label for="answer_two" class="col-md-2 col-form-label text-md-right">{{ __('جواب دو *'  ) }}</label>
                                            <div class="col-md-8">
                                                <input  id="answer_two" type="text" class="form-control{{ $errors->has('answer_two') ? 'is-invalid' : '' }}" name="answer_two"   required >
                                                @if ($errors->has('answer_two'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row afra-p-top2">
                                            <label for="answer_three" class="col-md-2 col-form-label text-md-right">{{ __('جواب سه *'  ) }}</label>
                                            <div class="col-md-8">
                                                <input  id="answer_three" type="text" class="form-control{{ $errors->has('answer_three') ? 'is-invalid' : '' }}" name="answer_three"   required >
                                                @if ($errors->has('answer_three'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row afra-p-top2">
                                            <label for="answer_four" class="col-md-2 col-form-label text-md-right">{{ __('جواب چهار *'  ) }}</label>
                                            <div class="col-md-8">
                                                <input  id="answer_four" type="text" class="form-control{{ $errors->has('answer_four') ? 'is-invalid' : '' }}" name="answer_four"   required >
                                                @if ($errors->has('answer_four'))
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
                                                    {{ __('تعریف ') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    {{--end form--}}
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-12 card  afra-p-b-20">

                            <div class="row  {{$color->title}}" >
                                <div class="col-md-1 d-none d-sm-block    border">وضعیت</div>
                                <div class="col-md-2 d-none d-sm-block  border">سوال </div>
                                <div class="col-md-1 d-none d-sm-block border ">پاسخ یک  </div>
                                <div class="col-md-2 d-none d-sm-block border ">پاسخ دو  </div>
                                <div class="col-md-2 d-none d-sm-block border ">پاسخ سه  </div>
                                <div class="col-md-2 d-none d-sm-block border ">پاسخ چهار  </div>
                                <div class="col-md-1 d-none d-sm-block border ">ویرایش </div>
                                <div class="col-md-1 d-none d-sm-block border ">حذف  </div>
                            </div>
                            @foreach ($surveys as $survey)
                                <div class="row  " >
                                    <div class="col-md-1 d-none d-sm-block border">
                                        @if($survey->active == "1")
                                            <form method="post" action="/admin/inactiveSurvey" >
                                                @csrf
                                                <input  name="id" type="hidden"  value="{{$survey->id}}">
                                                <button type="submit"  class="btn afra-btn-hide">
                                                    <i class="fas fa-check afra-f-20 p-3 text-success"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form method="post" action="/admin/activeSurvey" >
                                                @csrf
                                                <input  name="id" type="hidden"  value="{{$survey->id}}">
                                                <button type="submit"  class="btn afra-btn-hide">
                                                    <i class="fas fa-check afra-f-20 p-3 text-danger"></i>
                                                </button>
                                            </form>

                                        @endif
                                    </div>
                                    <div class="col-md-2 d-none d-sm-block border">{{$survey->question}}</div>
                                    <div class="col-md-1 d-none d-sm-block border">{{$survey->answer_one}}</div>
                                    <div class="col-md-2 d-none d-sm-block border">{{$survey->answer_two}}</div>
                                    <div class="col-md-2 d-none d-sm-block border">{{$survey->answer_three}}</div>
                                    <div class="col-md-2 d-none d-sm-block border">{{$survey->answer_four}}</div>
                                    <div class="col-md-1 d-none d-sm-block border center">
                                        <button type="button"     class="btn {{$color->main_three}} afra-white" data-toggle="collapse" href="#collapseExample{{$survey->id}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$survey->id}}">
                                            <i class="fas fa-edit  afra-f-20 p-3 text-success"></i>
                                        </button>
                                    </div>

                                    <div class="col-md-1 d-none d-sm-block border center">
                                        <form method="post" action="/admin/deleteSurvey" >
                                            @csrf
                                            <input  name="id" type="hidden"  value="{{$survey->id}}">
                                            <button type="submit"  class="btn afra-btn-hide">
                                                <i class="fas fa-window-close afra-f-20 p-3 text-danger"></i>
                                            </button>
                                        </form>

                                    </div>
                                    <div class="collapse   afra-w-100" id="collapseExample{{$survey->id}}">
                                        <div class="card card-body right">
                                            <form method="post" action="/admin/editSurvey" >
                                                @csrf
                                                <input  name="id" type="hidden"  value="{{$survey->id}}">
                                                <div class="form-group row ">
                                                    <label for="question" class="col-md-2 col-form-label text-md-right">{{ __('سوال'  ) }}</label>
                                                    <div class="col-md-8">
                                                        <input  id="question" type="text" class="form-control{{ $errors->has('question') ? 'is-invalid' : '' }}" name="question"    value="{{$survey->question}}" />
                                                        @if ($errors->has('question'))
                                                            <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="answer_one" class="col-md-2 col-form-label text-md-right">{{ __('   پاسخ یک'  ) }}</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" id="answer_one" type="text" class="form-control{{ $errors->has('answer_one') ? 'is-invalid' : '' }}" name="answer_one"  >{{ $survey->answer_one }}</textarea>
                                                        @if ($errors->has('answer_one'))
                                                            <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="answer_two" class="col-md-2 col-form-label text-md-right">{{ __('پاسخ دو'  ) }}</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" id="answer_two" type="text" class="form-control{{ $errors->has('answer_two') ? 'is-invalid' : '' }}" name="answer_two"  >{{ $survey->answer_two }}</textarea>
                                                        @if ($errors->has('answer_two'))
                                                            <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="description_one" class="col-md-2 col-form-label text-md-right">{{ __('پاسخ سه'  ) }}</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" id="answer_three" type="text" class="form-control{{ $errors->has('answer_three') ? 'is-invalid' : '' }}" name="answer_three"  >{{ $survey->answer_three }}</textarea>
                                                        @if ($errors->has('answer_three'))
                                                            <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="answer_four" class="col-md-2 col-form-label text-md-right">{{ __('پاسخ چهار'  ) }}</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" id="answer_four" type="text" class="form-control{{ $errors->has('answer_four') ? 'is-invalid' : '' }}" name="answer_four"  >{{ $survey->answer_four }}</textarea>
                                                        @if ($errors->has('answer_four'))
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

                {{-- **************************************************** --}}
                <div class="tab-pane fade" id="menu-two" role="tabpanel" aria-labelledby="menu-two-tab">
                    <div class="row">
                        <div class="col-md-12 card  afra-p-b-20">

                            <div class="row  {{$color->title}}" >
                                <div class="col-md-1 d-none d-sm-block    border">وضعیت </div>
                                <div class="col-md-3 d-none d-sm-block    border">نام </div>
                                <div class="col-md-2 d-none d-sm-block  border">تلفن </div>
                                <div class="col-md-2 d-none d-sm-block border ">تاریخ </div>
                                <div class="col-md-2 d-none d-sm-block border ">مشاهده سوال جواب </div>
                                <div class="col-md-2 d-none d-sm-block border ">حذف  </div>
                            </div>
                            @foreach ($answers as $answer)
                                <div class="row  center" >
                                    <div class="col-md-1 d-none d-sm-block border">
                                        @if($answer->active == "1")
                                            <form method="post" action="/admin/inactiveAnswer" >
                                                @csrf
                                                <input  name="id" type="hidden"  value="{{$answer->id}}">
                                                <button type="submit"  class="btn afra-btn-hide">
                                                    <i class="fas fa-check afra-f-20 p-3 text-success"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form method="post" action="/admin/activeAnswer" >
                                                @csrf
                                                <input  name="id" type="hidden"  value="{{$answer->id}}">
                                                <button type="submit"  class="btn afra-btn-hide">
                                                    <i class="fas fa-check afra-f-20 p-3 text-danger"></i>
                                                </button>
                                            </form>

                                        @endif
                                    </div>
                                    <div class="col-md-3 d-none d-sm-block border afra-p-top1">{{$answer->name_family}}</div>
                                    <div class="col-md-2 d-none d-sm-block border afra-p-top1">{{$answer->mobile}}</div>
                                    <div class="col-md-2 d-none d-sm-block border afra-p-top1">{{$answer->date}}</div>
                                    <div class="col-md-2 d-none d-sm-block border afra-p-top1">
                                        <a class="btn btn-primary afta-m-top" data-toggle="collapse" href="#collapseExample{{$answer->id}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$answer->id}}">
                                           مشاهده
                                        </a>

                                    </div>


                                    <div class="col-md-2 d-none d-sm-block border center">
                                        <form method="post" action="/admin/deleteAnswer" >
                                            @csrf
                                            <input  name="id" type="hidden"  value="{{$answer->id}}">
                                            <button type="submit"  class="btn afra-btn-hide">
                                                <i class="fas fa-window-close afra-f-20 p-3 text-danger"></i>
                                            </button>
                                        </form>

                                    </div>
                                    <div class="collapse   afra-w-100" id="collapseExample{{$answer->id}}">
                                        <div class="card card-body right">

                                            <h6 >{{$answer->question_one}}<b class="afra-green"> {{$answer->answer_one}}</b></h6>
                                            <h6>{{$answer->question_two}} <b class="afra-green"> {{$answer->answer_two}}</b></h6>
                                            <h6>{{$answer->question_three}} <b class="afra-green"> {{$answer->answer_three}}</b></h6>
                                            <h6>{{$answer->question_four}} <b class="afra-green"> {{$answer->answer_four}}</b></h6>
                                            <h6>{{$answer->question_five}} <b class="afra-green"> {{$answer->answer_five}}</b></h6>
                                            <h6>{{$answer->question_six}} <b class="afra-green"> {{$answer->answer_six}}</b></h6>
                                            <h6>{{$answer->question_seven}} <b class="afra-green"> {{$answer->answer_seven}}</b></h6>
                                            <h6>{{$answer->question_eight}} <b class="afra-green"> {{$answer->answer_eight}}</b></h6>
                                            <h6>{{$answer->question_nine}} <b class="afra-green"> {{$answer->answer_nine}}</b></h6>
                                            <h6>{{$answer->question_ten}} <b class="afra-green"> {{$answer->answer_ten}}</b></h6>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- ***********************************************************--}}
            </div>

        </div>
        <br>
</div>
</div>


    </div>
</div>
</div>
@endsection
