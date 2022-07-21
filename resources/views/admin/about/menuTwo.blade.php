<div class="container afra-p-b-20">
    <form method="POST" action="{{url('admin/menuOneRecord')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="manager" name="group_about">
        <div class="row">
            <div class="container ">
                <div class="row justify-content-center ">
                    <div class="col-md-12 afra-padd-bottom  ">
                        <div class="col-md-6 offset-md-1 afra-p-top2" >  <h4 > تعریف {{$header->menu_two}} </h4></div>
                        <div class="form-group row afra-p-top2">
                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('سمت   *'  ) }}</label>
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
                            <label for="description_one" class="col-md-2 col-form-label text-md-right">{{ __('نام و نام خانوادگی   *'  ) }}</label>
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
                            <label for="description_two" class="col-md-2 col-form-label text-md-right">{{ __('توضیحات   *'  ) }}</label>
                            <div class="col-md-8">
                                <textarea rows="2" id="description_two" type="text" class="form-control{{ $errors->has('description_two') ? 'is-invalid' : '' }}" name="description_two"  required></textarea>
                                @if ($errors->has('description_two '))
                                    <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image_one " class="col-md-2 col-form-label text-md-right">{{ __('تصویر  ') }}</label>
                            <div class="col-md-8 ">
                                <input id="image_one" type="file" class="form-control{{ $errors->has('image_one') ? ' is-invalid' : '' }}" name="image_one"/>
                                @if ($errors->has('image_one'))
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
                                    {{ __('تعریف '.$header->menu_two) }}
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
<div class="col-md-3 d-none d-sm-block  border">سمت </div>
<div class="col-md-2 d-none d-sm-block border ">نام  </div>
<div class="col-md-2 d-none d-sm-block border ">توضیحات  </div>
<div class="col-md-2 d-none d-sm-block border ">تصویر اصلی</div>
<div class="col-md-1 d-none d-sm-block border ">ویرایش </div>
<div class="col-md-1 d-none d-sm-block border ">حذف  </div>
</div>
@foreach ($abouts as $about)
        @if($about->group_about == "manager")
<div class="row  " >
    <div class="col-md-1 d-none d-sm-block border">
        @if($about->active == "1")
            <form method="post" action="/admin/inactiveAbout" >
                @csrf
                <input  name="id" type="hidden"  value="{{$about->id}}">
                <button type="submit"  class="btn afra-btn-hide">
                    <i class="fas fa-check afra-f-20 p-3 text-success"></i>
                </button>
            </form>
        @else
            <form method="post" action="/admin/activeAbout" >
                @csrf
                <input  name="id" type="hidden"  value="{{$about->id}}">
                <button type="submit"  class="btn afra-btn-hide">
                    <i class="fas fa-check afra-f-20 p-3 text-danger"></i>
                </button>
            </form>

        @endif
    </div>
    <div class="col-md-3 d-none d-sm-block border">{{$about->title}}</div>
    <div class="col-md-2 d-none d-sm-block border">{{$about->description_one}}</div>
    <div class="col-md-2 d-none d-sm-block border">{{$about->description_two}}</div>

    <div class="col-md-2 d-none d-sm-block border ">
        <img src="managers/{{$about->image_one}}" alt="{{$general->alt}}" width="100"  />
    </div>
    <div class="col-md-1 d-none d-sm-block border center">
        <button type="button"     class="btn {{$color->main_three}} afra-white" data-toggle="collapse" href="#collapseExample{{$about->id}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$about->id}}">
            <i class="fas fa-edit  afra-f-20 p-3 text-success"></i>
        </button>
    </div>

<div class="col-md-1 d-none d-sm-block border center">
<form method="post" action="/admin/deleteAbout" >
@csrf
<input  name="id" type="hidden"  value="{{$about->id}}">
<button type="submit"  class="btn afra-btn-hide">
<i class="fas fa-window-close afra-f-20 p-3 text-danger"></i>
</button>
</form>

</div>
    {{--***************************************************************************--}}
    <div class="collapse   afra-w-100" id="collapseExample{{$about->id}}">
        <div class="card card-body right">
            <form method="post" action="/admin/editAbout" enctype="multipart/form-data">
                @csrf
                <input  name="id" type="hidden"  value="{{$about->id}}">
                <div class="form-group row ">
                    <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('سمت '  ) }}</label>
                    <div class="col-md-8">
                        <input  id="title" type="text" class="form-control{{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"    value="{{$about->title}}" />
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>خطا در هنگام ویرایش اطلاعات</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description_one" class="col-md-2 col-form-label text-md-right">{{ __('نام و نام خانوادگی  '  ) }}</label>
                    <div class="col-md-8">
                        <textarea rows="2" id="description_one" type="text" class="form-control{{ $errors->has('description_one') ? 'is-invalid' : '' }}" name="description_one"  >{{ $about->description_one }}</textarea>
                        @if ($errors->has('description_one'))
                            <span class="invalid-feedback" role="alert">
                                <strong>خطا در هنگام ویرایش اطلاعات</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description_two" class="col-md-2 col-form-label text-md-right">{{ __('توضیحات '  ) }}</label>
                    <div class="col-md-8">
                        <textarea rows="2" id="description_two" type="text" class="form-control{{ $errors->has('description_two') ? 'is-invalid' : '' }}" name="description_two"  >{{ $about->description_two }}</textarea>
                        @if ($errors->has('description_two'))
                            <span class="invalid-feedback" role="alert">
                                <strong>خطا در هنگام ویرایش اطلاعات</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image_one " class="col-md-2 col-form-label text-md-right">{{ __('تصویر  ') }}</label>
                    <div class="col-md-8 ">
                        <input id="image_one" type="file" class="form-control{{ $errors->has('image_one') ? ' is-invalid' : '' }}" name="image_one"/>
                        @if ($errors->has('image_one'))
                            <span class="invalid-feedback" role="alert">
                                <strong>لطفا استاندارد های آپلود تصویر را رعایت نمایید .</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row ">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit"  class="btn {{$color->button}} afra-white ">
                            ویرایش
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    {{--*************************************************************************--}}
</div>
        @endif
@endforeach
</div>
</div>
</div>
<br>
