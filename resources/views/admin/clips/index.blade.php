@foreach ($colors as $color) @endforeach

@extends('style_admin')
<?php
$title =  "مدیریت آپلود کلیپ  "  ;
$v = verta();
?>
{{session(['name_panel'=>$title])}}
{{session(['id'=>'3'])}}
@section('content')
    <div class="row   ">
        {{--start menu--}}
        @include('admin.menu')
        {{--end menu--}}
        <div class="col-md-10   offset-md-2  afra-m-top-2 ">
            @if(session()->has('delete'))
                <div class="alert alert-success ">
                    کلیپ با موفقیت حذف شد .
                </div>
            @endif
            @if(session()->has('inactive'))
                <div class="alert alert-success ">
                    کلیپ با موفقیت غیر فعال شد .
                </div>
            @endif
            @if(session()->has('active'))
                <div class="alert alert-success ">
                    کلیپ با موفقیت فعال شد .
                </div>
            @endif
            @if(session()->has('record'))
                <div class="alert alert-success ">
                    آپلود کلیپ  با موفقیت انجام شد .
                </div>
            @endif

            @if(session()->has('edit'))
                <div class="alert alert-success ">
                    ویرایش کلیپ با موفقیت انجام شد .
                </div>
            @endif
            <div class="container afra-p-b-20">
                <form method="POST" action="{{url('admin/clipRecord')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="container ">
                            <div class="row justify-content-center ">
                                <div class="col-md-12 afra-padd-bottom card ">
                                    <div class="col-md-4 offset-md-1 afra-p-top2" >  <h4 >آپلود کلیپ ویدئویی</h4></div>
                                    <div class="form-group row afra-p-top2">
                                        <label for="datepicker4" class="col-md-2 col-form-label text-md-right">{{ __('تاریخ کلیپ *'  ) }}</label>
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
                                        <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('عنوان کلیپ *'  ) }}</label>
                                        <div class="col-md-8">
                                            <input  id="title" type="text" class="form-control{{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"   required >
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-md-2 col-form-label text-md-right">{{ __(' توضیحات کلیپ '  ) }}</label>
                                        <div class="col-md-8">
                                            <textarea rows="2" id="description" type="text" class="form-control{{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"  required></textarea>
                                            @if ($errors->has('description '))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="img_video " class="col-md-2 col-form-label text-md-right">{{ __('انتخاب تصویر اصلی برای کلیپ *') }}</label>
                                        <div class="col-md-8 ">
                                            <input id="img_video" type="file" class="form-control{{ $errors->has('img_video') ? ' is-invalid' : '' }}" name="img_video"  required >
                                            @if ($errors->has('img_video'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>لطفا استاندارد های آپلود تصویر را رعایت نمایید .</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label for="video " class="col-md-2 col-form-label text-md-right">{{ __('انتخاب کلیپ *') }}</label>
                                        <div class="col-md-8 ">
                                            <input id="video" type="file" class="form-control{{ $errors->has('video') ? ' is-invalid' : '' }}" name="video"/>
                                            @if ($errors->has('video'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>لطفا استاندارد های آپلود ویدئو را رعایت نمایید .</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>



                                    {{--data login--}}
                                    <div class="form-group row ">
                                        <div class="col-md-8 offset-md-2">
                                            <button type="submit" class="btn {{$color->button}} afra-white wrn-btn">
                                                {{ __('آپلود کلیپ ') }}
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
                            <div class="col-md-1 d-none d-sm-block    border">وضعیت</div>
                            <div class="col-md-3 d-none d-sm-block  border">عنوان کلیپ</div>
                            <div class="col-md-2 d-none d-sm-block border ">توضیحات </div>
                            <div class="col-md-2 d-none d-sm-block border ">تصویر اصلی</div>
                            <div class="col-md-2 d-none d-sm-block border ">ویرایش </div>
                            <div class="col-md-2 d-none d-sm-block border ">حذف کلیپ </div>
                        </div>
                        @foreach ($videos as $video)
                            <div class="row  " >
                                <div class="col-md-1 d-none d-sm-block border">
                                    @if($video->active == "1")
                                        <form method="post" action="/admin/inactiveClips" >
                                            @csrf
                                            <input  name="id" type="hidden"  value="{{$video->id}}">
                                            <button type="submit"  class="btn afra-btn-hide">
                                                <i class="fas fa-check afra-f-20 p-3 text-success"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form method="post" action="/admin/activeClips" >
                                            @csrf
                                            <input  name="id" type="hidden"  value="{{$video->id}}">
                                            <button type="submit"  class="btn afra-btn-hide">
                                                <i class="fas fa-check afra-f-20 p-3 text-danger"></i>
                                            </button>
                                        </form>

                                    @endif
                                </div>
                                <div class="col-md-3 d-none d-sm-block border">{{$video->title}}</div>
                                <div class="col-md-2 d-none d-sm-block border">{{$video->description}}</div>
                                <div class="col-md-2 d-none d-sm-block border "><img src="videos/img_video//{{$video->img_video}}" alt="ftm" width="100" />  </div>
                                <div class="col-md-2 d-none d-sm-block border center">
                                    <form method="POST" action="" >
                                        @csrf
                                        <input type="hidden" name="id" value="{{$video->id}}">
                                        <button type="button"   data-toggle="modal" data-target=".bd-example-modal-lg"  class="btn {{$color->main_three}}
                                                afra-white" onClick="formget(this.form,'/admin/editClips');">
                                            <i class="fas fa-edit  afra-f-20 p-3 text-success"></i>
                                        </button>
                                    </form>
                                </div>

                                <div class="col-md-2 d-none d-sm-block border center">
                                    <form method="post" action="/admin/deleteClips" >
                                        @csrf
                                        <input  name="id" type="hidden"  value="{{$video->id}}">
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
                    <h4 class="modal-title">ویرایش کلیپ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-content">
                    <div id="showresult"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
