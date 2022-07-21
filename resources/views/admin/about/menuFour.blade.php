<div class="container afra-p-b-20">
    <form method="POST" action="{{url('admin/license')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="container ">
                <div class="row justify-content-center ">
                    <div class="col-md-12 afra-padd-bottom  ">
                        <div class="col-md-6 offset-md-1 afra-p-top2" >  <h4 > تعریف  {{$header->menu_four}}  </h4></div>
                        <div class="form-group row afra-p-top2">
                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('عنوان '.$header->menu_four.' *'  ) }}</label>
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
                            <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('توضیحات '.$header->menu_four.' *'  ) }}</label>
                            <div class="col-md-8">
                                <textarea rows="5" id="description" type="text" class="form-control{{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"  required></textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image_one " class="col-md-2 col-form-label text-md-right">{{ __('تصویر مجوز ') }}</label>
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
                                    {{ __('تعریف '.$header->menu_four) }}
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
                <div class="col-md-3 d-none d-sm-block  border">عنوان </div>
                <div class="col-md-2 d-none d-sm-block border ">توضیحات  </div>
                <div class="col-md-2 d-none d-sm-block border ">تصویر اصلی</div>
                <div class="col-md-2 d-none d-sm-block border ">ویرایش </div>
                <div class="col-md-2 d-none d-sm-block border ">حذف  </div>
            </div>
    @foreach ($licenses as $license)
        <div class="row  " >
            <div class="col-md-1 d-none d-sm-block border">
                @if($license->active == "1")
                    <form method="post" action="/admin/inactiveLicenses" >
                        @csrf
                        <input  name="id" type="hidden"  value="{{$license->id}}">
                        <button type="submit"  class="btn afra-btn-hide">
                            <i class="fas fa-check afra-f-20 p-3 text-success"></i>
                        </button>
                    </form>
                @else
                    <form method="post" action="/admin/activeLicenses" >
                        @csrf
                        <input  name="id" type="hidden"  value="{{$license->id}}">
                        <button type="submit"  class="btn afra-btn-hide">
                            <i class="fas fa-check afra-f-20 p-3 text-danger"></i>
                        </button>
                    </form>
                @endif
            </div>
            <div class="col-md-3 d-none d-sm-block border">{{$license->title}}</div>
            <div class="col-md-2 d-none d-sm-block border">{{$license->description}}</div>

            <div class="col-md-2 d-none d-sm-block border "><img src="licenses/{{$license->image}}" alt="{{$general->alt}}" width="100" />  </div>
            <div class="col-md-2 d-none d-sm-block border center">
                <button type="button"     class="btn {{$color->main_three}} afra-white" data-toggle="collapse" href="#collapseExample{{$license->id}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$license->id}}">
                    <i class="fas fa-edit  afra-f-20 p-3 text-success"></i>
                </button>
            </div>

            <div class="col-md-2 d-none d-sm-block border center">
                <form method="post" action="/admin/deleteLicenses" >
                    @csrf
                    <input  name="id" type="hidden"  value="{{$license->id}}">
                    <button type="submit"  class="btn afra-btn-hide">
                        <i class="fas fa-window-close afra-f-20 p-3 text-danger"></i>
                    </button>
                </form>

            </div>
            <div class="collapse   afra-w-100" id="collapseExample{{$license->id}}">
                <div class="card card-body right">
                    <form method="post" action="/admin/editLicense" enctype="multipart/form-data">
                        @csrf
                        <input  name="id" type="hidden"  value="{{$license->id}}">
                        <div class="form-group row ">
                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('عنوان مجوز'  ) }}</label>
                            <div class="col-md-8">
                                <input  id="title" type="text" class="form-control{{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"    value="{{$license->title}}" />
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description_one" class="col-md-2 col-form-label text-md-right">{{ __('توضیحات مجوز  '  ) }}</label>
                            <div class="col-md-8">
                                <textarea rows="2" id="description" type="text" class="form-control{{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"  >{{ $license->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('تغییر تصویر مجوز  ') }}</label>
                            <div class="col-md-8 ">
                                <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image"/>
                                @if ($errors->has('image'))
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
        </div>
    @endforeach
</div>
</div>
</div>
<br>
