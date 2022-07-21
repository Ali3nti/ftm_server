@foreach ($colors as $color) @endforeach
<div class="container afra-p-b-20">
    @foreach ($products as $product)
        @if($product->id == $_POST['id'])
            <div class="container ">
                <form method="POST" action="{{url('admin/editProductsEnd')}}" enctype="multipart/form-data">
                    @csrf
                        <input  name="id" type="hidden"  value="{{ $product->id }}">
                        <div class="row">
                            <div class="container ">
                                <div class="row justify-content-center ">
                                    <div class="col-md-12 afra-padd-bottom  ">
                                        <div class="form-group row">
                                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('عنوان محصول'  ) }}</label>
                                            <div class="col-md-8">
                                                <textarea rows="2" id="title" type="text" class="form-control{{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"  >{{ $product->title }}</textarea>
                                                @if ($errors->has('title'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('توضیحات محصول') }}</label>
                                            <div class="col-md-8">
                                                <textarea rows="5" id="description" type="text" class="form-control{{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"  >{{ $product->description }}</textarea>
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
                                                    {{ __('ویرایش مشخصات محصول') }}
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
