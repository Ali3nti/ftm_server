@foreach ($colors as $color) @endforeach

@extends('style_admin')
<?php
$title =  "مدیریت اخبار "  ;
$v = verta();
?>
 {{session(['name_panel'=>$title])}}
 {{session(['id'=>'2'])}}
@section('content')
<div class="row   ">
{{--start menu--}}
@include('admin.menu')
{{--end menu--}}
<div class="col-md-10   offset-md-2  afra-m-top-2 ">
    @if(session()->has('delete'))
        <div class="alert alert-success ">
        خبر با موفقیت حذف شد .
        </div>
    @endif
        @if(session()->has('inactive'))
            <div class="alert alert-success ">
                خبر با موفقیت غیر فعال شد .
            </div>
        @endif
        @if(session()->has('active'))
            <div class="alert alert-success ">
                خبر با موفقیت فعال شد .
            </div>
        @endif
        @if(session()->has('archives'))
            <div class="alert alert-success ">
                خبر با موفقیت آرشیو شد .
            </div>
        @endif
        @if(session()->has('nonArchive'))
            <div class="alert alert-success ">
                خبر با موفقیت از آرشیو خارج  شد .
            </div>
        @endif
        @if(session()->has('record'))
        <div class="alert alert-success ">
            ثبت اخبار  با موفقیت انجام شد .
        </div>
    @endif

        @if(session()->has('edit'))
            <div class="alert alert-success ">
             ویرایش اخبار با موفقیت انجام شد .
            </div>
        @endif
        <div class="container afra-p-b-20">
            <form method="POST" action="{{url('admin/newsRecord')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="container ">
                        <div class="row justify-content-center ">
                            {{--start form--}}
                            {{--data general--}}
                            <div class="col-md-12 afra-padd-bottom card ">
                            <div class="col-md-4 offset-md-1 afra-p-top2" >  <h4 >اضافه کردن اخبار  جدید</h4></div>

                                <div class="form-group row afra-p-top2">
                                    <label for="datepicker4" class="col-md-2 col-form-label text-md-right">{{ __('تاریخ خبر *'  ) }}</label>
                                    <div class="col-md-8">
                                        <input  id="datepicker4" type="text" class="form-control{{ $errors->has('datepicker4') ? 'is-invalid' : '' }}" name="datepicker4"   required />
                                        @if ($errors->has('datepicker4 '))
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('تیتر خبر *'  ) }}</label>
                                    <div class="col-md-8">
                                        <textarea rows="2" id="title" type="text" class="form-control{{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"   required></textarea>
                                        @if ($errors->has('title '))
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description_one" class="col-md-2 col-form-label text-md-right">{{ __('  شرح خبر *'  ) }}</label>
                                    <div class="col-md-8">
                                        <textarea rows="2" id="description_one" type="text" class="form-control{{ $errors->has('description_one') ? 'is-invalid' : '' }}" name="description_one"  required></textarea>
                                        @if ($errors->has('description_one '))
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description_two " class="col-md-2 col-form-label text-md-right">{{ __('متن کامل خبر') }}</label>
                                    <div class="col-md-8">
                                        <textarea rows="15" id="description_two" type="text" class="form-control{{ $errors->has('description_two') ? 'is-invalid' : '' }}" name="description_two"  ></textarea>
                                        @if ($errors->has('description_two'))
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('description_two') }}</strong>
                                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="img_one " class="col-md-2 col-form-label text-md-right">{{ __('تصویر اصلی خبر *') }}</label>
                                    <div class="col-md-8 ">
                                        <input id="img_one" type="file" class="form-control{{ $errors->has('img_one') ? ' is-invalid' : '' }}" name="img_one"  required />
                                        @if ($errors->has('img_one'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>لطفا استاندارد های آپلود تصویر را رعایت نمایید .</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="img_two " class="col-md-2 col-form-label text-md-right">{{ __('تصویر دوم') }}</label>

                                    <div class="col-md-8 ">
                                        <input id="img_two" type="file" class="form-control{{ $errors->has('img_two') ? ' is-invalid' : '' }}" name="img_two"/>

                                    @if ($errors->has('img_two'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>لطفا استاندارد های آپلود تصویر را رعایت نمایید .</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="img_two " class="col-md-2 col-form-label text-md-right">{{ __('تصویر سوم') }}</label>
                                    <div class="col-md-8">
                                        <input id="img_three" type="file" class="form-control{{ $errors->has('img_three') ? ' is-invalid' : '' }}" name="img_three"/>
                                        @if ($errors->has('img_three'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>لطفا استاندارد های آپلود تصویر را رعایت نمایید .</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{--data login--}}
                                <div class="form-group row ">
                                    <div class="col-md-8 offset-md-2">
                                        <button type="submit" class="btn {{$color->button}} afra-white wrn-btn">
                                            {{ __('ثبت  خبر') }}
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

            <div class="container afra-p-b-20">
                <div class="row">
                <div class="col-md-12 card  afra-p-b-20">

                <div class="row  {{$color->title}}" >
                    <div class="col-md-1 d-none d-sm-block border">وضعیت</div>
                    <div class="col-md-3 d-none d-sm-block border">تیتر خبر</div>
                    <div class="col-md-2 d-none d-sm-block border ">تصویر </div>
                    <div class="col-md-2 d-none d-sm-block border ">ویرایش </div>
                    <div class="col-md-2 d-none d-sm-block border ">آرشیو کردن </div>
                    <div class="col-md-2 d-none d-sm-block border ">حذف خبر </div>
                </div>
                    @foreach ($ftm_news as $ftm_new)
                <div class="row  " >
                    <div class="col-md-1 d-none d-sm-block border">
                        @if($ftm_new->active == "1")
                        <form method="post" action="/admin/inactiveNews" >
                            @csrf
                            <input  name="id" type="hidden"  value="{{$ftm_new->id}}">
                            <button type="submit"  class="btn afra-btn-hide">
                                <i class="fas fa-check afra-f-20 p-3 text-success"></i>
                            </button>
                        </form>
                            @else
                            <form method="post" action="/admin/activeNews" >
                                @csrf
                                <input  name="id" type="hidden"  value="{{$ftm_new->id}}">
                                <button type="submit"  class="btn afra-btn-hide">
                                    <i class="fas fa-check afra-f-20 p-3 text-danger"></i>
                                </button>
                            </form>

                        @endif
                    </div>
                    <div class="col-md-3 d-none d-sm-block border">{{$ftm_new->title}}</div>
                    <div class="col-md-2 d-none d-sm-block border "><img src="news/{{$ftm_new->img_one}}" alt="ftm" width="100" />  </div>
                    <div class="col-md-2 d-none d-sm-block border center">
                        <form method="POST" action="" >
                            @csrf
                            <input type="hidden" name="id" value="{{$ftm_new->id}}">
                        <button type="button"   data-toggle="modal" data-target=".bd-example-modal-lg"  class="btn {{$color->main_three}}
                                afra-white" onClick="formget(this.form,'/admin/editNews');">
                        <i class="fas fa-edit  afra-f-20 p-3 text-success"></i>
                        </button>
                        </form>
                    </div>
                    <div class="col-md-2 d-none d-sm-block border center">
                        @if($ftm_new->active == "1")
                            <form method="post" action="/admin/archivesNews" >
                                @csrf
                                <input  name="id" type="hidden"  value="{{$ftm_new->id}}">
                                <button type="submit"  class="btn afra-btn-hide">
                                    <i class="fas fa-unlock-alt afra-f-20 p-3 text-info"></i>
                                </button>
                            </form>
                        @else
                            <form method="post" action="/admin/nonArchiveNews" >
                                @csrf
                                <input  name="id" type="hidden"  value="{{$ftm_new->id}}">
                                <button type="submit"  class="btn afra-btn-hide">
                                    <i class="fas fa-lock afra-f-20 p-3 text-warning"></i>

                                </button>
                            </form>

                        @endif


                    </div>
                    <div class="col-md-2 d-none d-sm-block border center">
                        <form method="post" action="/admin/deleteNews" >
                            @csrf
                            <input  name="id" type="hidden"  value="{{$ftm_new->id}}">
                            <button type="submit"  class="btn afra-btn-hide">
                                <i class="fas fa-window-close afra-f-20 p-3 text-danger"></i>
                            </button>
                        </form>

                    </div>

                </div>
                    @endforeach
            </div>
            </div>
            </div>
            <br>


</div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">ویرایش خبر</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-content">
            <div id="showresult"></div>
        </div>
    </div>
    </div>
</div>

@endsection
