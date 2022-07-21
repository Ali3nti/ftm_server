@foreach ($colors as $color) @endforeach
<div class="container afra-p-b-20">
    @foreach ($images as $image)
        @if($image->id == $_POST['id'])
            <div class="container ">
                <form method="POST" action="{{url('admin/editImagesEnd')}}" enctype="multipart/form-data">
                    @csrf
                        <input  name="id" type="hidden"  value="{{ $image->id }}">
                        <div class="row">
                            <div class="container ">
                                <div class="row justify-content-center ">
                                    <div class="col-md-12 afra-padd-bottom  ">
                                        <div class="form-group row ">
                                            <label for="group_img" class="col-md-2 col-form-label text-md-right">{{ __('گروه تصویر'  ) }}</label>
                                            <div class="col-md-8">
                                                <input  id="group_img" type="text" class="form-control{{ $errors->has('group_img') ? 'is-invalid' : '' }}" name="group_img"    value="{{$image->group_img}}" />
                                                @if ($errors->has('group_img'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('عنوان کلیپ'  ) }}</label>
                                            <div class="col-md-8">
                                                <textarea rows="2" id="title" type="text" class="form-control{{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"  >{{ $image->title }}</textarea>
                                                @if ($errors->has('title'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('توضیحات کلیپ') }}</label>
                                            <div class="col-md-8">
                                                <textarea rows="5" id="description" type="text" class="form-control{{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"  >{{ $image->description }}</textarea>
                                                @if ($errors->has('description'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('description') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        {{--data login--}}
                                        <div class="form-group row ">
                                            <div class="col-md-8 offset-md-2">
                                                <button type="submit" class="btn {{$color->button}} afra-white wrn-btn">
                                                    {{ __('ویرایش مشخصات تصویر') }}
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
