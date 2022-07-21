@foreach ($colors as $color) @endforeach
<div class="container afra-p-b-20">
    @foreach ($videos as $video)
        @if($video->id == $_POST['id'])
            <div class="container ">
                <form method="POST" action="{{url('admin/editClipsEnd')}}" enctype="multipart/form-data">
                    @csrf
                        <input  name="id" type="hidden"  value="{{ $video->id }}">
                        <div class="row">
                            <div class="container ">
                                <div class="row justify-content-center ">
                                    <div class="col-md-12 afra-padd-bottom  ">
                                        <div class="form-group row ">
                                            <label for="date_news" class="col-md-2 col-form-label text-md-right">{{ __('تاریخ کلیپ'  ) }}</label>
                                            <div class="col-md-8">
                                                <input  id="date_news" type="text" class="form-control{{ $errors->has('date_news') ? 'is-invalid' : '' }}" name="date_news"    value="{{$video->date_news}}" />
                                                @if ($errors->has('date_news'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('عنوان کلیپ'  ) }}</label>
                                            <div class="col-md-8">
                                                <textarea rows="2" id="title" type="text" class="form-control{{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"  >{{ $video->title }}</textarea>
                                                @if ($errors->has('title '))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('توضیحات کلیپ') }}</label>
                                            <div class="col-md-8">
                                                <textarea rows="5" id="description" type="text" class="form-control{{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"  >{{ $video->description }}</textarea>
                                                @if ($errors->has('description'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('description') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="img_video " class="col-md-2 col-form-label text-md-right">{{ __('تغییر تصویر اصلی برای کلیپ *') }}</label>
                                            <div class="col-md-8 ">
                                                <input id="img_video" type="file" class="form-control{{ $errors->has('img_video') ? ' is-invalid' : '' }}" name="img_video"  required >
                                                @if ($errors->has('img_video'))
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
                                                    {{ __('ویرایش مشخصات کلیپ') }}
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
                @endif
            @endforeach
        </div>
