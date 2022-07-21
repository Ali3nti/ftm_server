<div class="container afra-p-b-20">

    <form method="POST" action="{{url('admin/menuFiveRecord')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="glance" name="group_about">
        <div class="row">
            <div class="container ">
                <div class="row justify-content-center ">
                    <div class="col-md-12 afra-padd-bottom  ">
                        <div class="col-md-6 offset-md-1 afra-p-top2" >  <h4 > تعریف FTM در رسانه ها</h4></div>
                        <div class="form-group row afra-p-top2">
                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('نام رسانه *'  ) }}</label>
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
                            <label for="subject" class="col-md-2 col-form-label text-md-right">{{ __('موضوع FTM در رسانه ها  *'  ) }}</label>
                            <div class="col-md-8">
                                <textarea rows="3" id="subject" type="text" class="form-control{{ $errors->has('subject') ? 'is-invalid' : '' }}" name="subject"  required></textarea>
                                @if ($errors->has('subject '))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row afra-p-top2">
                            <label for="links" class="col-md-2 col-form-label text-md-right">{{ __('لینک رسانه *'  ) }}</label>
                            <div class="col-md-8">
                                <input  id="links" type="text" class="form-control{{ $errors->has('links') ? 'is-invalid' : '' }}" name="links"   required >
                                @if ($errors->has('links'))
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
                                    {{ __('تعریف FTM در رسانه ها ') }}
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
                <div class="col-md-3 d-none d-sm-block  border">نام رسانه </div>
                <div class="col-md-6 d-none d-sm-block border "> موضوع </div>
                <div class="col-md-1 d-none d-sm-block border ">ویرایش </div>
                <div class="col-md-1 d-none d-sm-block border ">حذف  </div>
            </div>
            @foreach ($newspapers as $newspaper)
                <div class="row  " >
                    <div class="col-md-1 d-none d-sm-block border">
                        @if($newspaper->active == "1")
                            <form method="post" action="/admin/inactivePaper" >
                                @csrf
                                <input  name="id" type="hidden"  value="{{$newspaper->id}}">
                                <button type="submit"  class="btn afra-btn-hide">
                                    <i class="fas fa-check afra-f-20 p-3 text-success"></i>
                                </button>
                            </form>
                        @else
                            <form method="post" action="/admin/activePaper" >
                                @csrf
                                <input  name="id" type="hidden"  value="{{$newspaper->id}}">
                                <button type="submit"  class="btn afra-btn-hide">
                                    <i class="fas fa-check afra-f-20 p-3 text-danger"></i>
                                </button>
                            </form>

                        @endif
                    </div>
                    <div class="col-md-3 d-none d-sm-block border">{{$newspaper->title}}</div>
                    <div class="col-md-6 d-none d-sm-block border">{{$newspaper->subject}}</div>
                    <div class="col-md-1 d-none d-sm-block border center">
                        <button type="button"     class="btn {{$color->main_three}} afra-white" data-toggle="collapse" href="#collapseExample{{$newspaper->id}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$newspaper->id}}">
                            <i class="fas fa-edit  afra-f-20 p-3 text-success"></i>
                        </button>
                    </div>

                    <div class="col-md-1 d-none d-sm-block border center">
                        <form method="post" action="/admin/deletePaper" >
                            @csrf
                            <input  name="id" type="hidden"  value="{{$newspaper->id}}">
                            <button type="submit"  class="btn afra-btn-hide">
                                <i class="fas fa-window-close afra-f-20 p-3 text-danger"></i>
                            </button>
                        </form>

                    </div>
                    <div class="collapse   afra-w-100" id="collapseExample{{$newspaper->id}}">
                        <div class="card card-body right">
                            <form method="post" action="/admin/editNewspaper" >
                                @csrf
                                <input  name="id" type="hidden"  value="{{$newspaper->id}}">
                                <div class="form-group row ">
                                    <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('نام رسانه '  ) }}</label>
                                    <div class="col-md-8">
                                        <input  id="title" type="text" class="form-control{{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"    value="{{$newspaper->title}}" />
                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="subject" class="col-md-2 col-form-label text-md-right">{{ __('موضوع  '  ) }}</label>
                                    <div class="col-md-8">
                                        <textarea rows="2" id="subject" type="text" class="form-control{{ $errors->has('subject') ? 'is-invalid' : '' }}" name="subject"  >{{ $newspaper->subject }}</textarea>
                                        @if ($errors->has('subject'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="links" class="col-md-2 col-form-label text-md-right">{{ __('لینک رسانه '  ) }}</label>
                                    <div class="col-md-8">
                                        <textarea rows="2" id="links" type="text" class="form-control{{ $errors->has('links') ? 'is-invalid' : '' }}" name="links"  >{{ $newspaper->links }}</textarea>
                                        @if ($errors->has('links'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row ">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit"  class="btn {{$color->button}} afra-white ">
                                            ویرایش FTM در رسانه
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
