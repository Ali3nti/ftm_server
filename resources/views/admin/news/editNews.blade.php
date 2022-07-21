@foreach ($colors as $color) @endforeach


        <div class="container afra-p-b-20">
            @foreach ($ftm_news as $ftm_new)
                @if($ftm_new->id == $_POST['id'])
                <div class="container ">
                    <form method="POST" action="{{url('admin/editNewsEnd')}}" enctype="multipart/form-data">
                        @csrf
                        <input  name="id" type="hidden"  value="{{ $ftm_new->id }}">
                        <div class="row">
                            <div class="container ">
                                <div class="row justify-content-center ">
                                    <div class="col-md-12 afra-padd-bottom  ">
                                        <div class="form-group row ">
                                            <label for="date_news" class="col-md-2 col-form-label text-md-right">{{ __('تاریخ خبر'  ) }}</label>
                                            <div class="col-md-8">
                                                <input  id="date_news" type="text" class="form-control{{ $errors->has('date_news') ? 'is-invalid' : '' }}" name="date_news"    value="{{$ftm_new->date_news}}" />
                                                @if ($errors->has('date_news'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('عنوان اخبار'  ) }}</label>
                                            <div class="col-md-8">
                                                <textarea rows="2" id="title" type="text" class="form-control{{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"  >{{ $ftm_new->title }}</textarea>
                                                @if ($errors->has('title '))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="description_one" class="col-md-2 col-form-label text-md-right">{{ __('متن اخبار') }}</label>
                                            <div class="col-md-8">
                                                <textarea rows="3" id="description_one" type="text" class="form-control{{ $errors->has('description_one') ? 'is-invalid' : '' }}" name="description_one"  >{{ $ftm_new->description_one }}</textarea>
                                                @if ($errors->has('description_one'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('description_one') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="description_two" class="col-md-2 col-form-label text-md-right">{{ __('متن اخبار') }}</label>
                                            <div class="col-md-8">
                                                <textarea rows="15" id="description_one" type="text" class="form-control{{ $errors->has('description_two') ? 'is-invalid' : '' }}" name="description_two"  >{{ $ftm_new->description_two }}</textarea>
                                                @if ($errors->has('description_two'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('description_two') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="img_one " class="col-md-2 col-form-label text-md-right">{{ __('تغییر تصویر اصلی خبر * ') }}</label>
                                            <div class="col-md-8 ">
                                                <input id="img_one" type="file" class="form-control{{ $errors->has('img_one') ? ' is-invalid' : '' }}" name="img_one"   />
                                                @if ($errors->has('img_one'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>لطفا استاندارد های آپلود تصویر را رعایت نمایید .</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label for="img_two " class="col-md-2 col-form-label text-md-right">{{ __('تغییر تصویر دوم ') }}</label>

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
                                            <label for="img_two " class="col-md-2 col-form-label text-md-right">{{ __('تغییر تصویر سوم ') }}</label>
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
                                                    {{ __('ویرایش اخبار') }}
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
