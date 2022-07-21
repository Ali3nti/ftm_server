@foreach ($colors as $color) @endforeach

@extends('style_admin')
@php($title =  "مدیریت ثبت نام ")

 {{session(['name_panel'=>$title])}}
 {{session(['id'=>'11'])}}
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
                    حذف   با موفقیت انجام شد
                </div>
                @endif
                @if(session()->has('active'))
                <div class="alert alert-success ">
                    کاربر مورد نظر فعال  شد .
                </div>
                @endif
                @if(session()->has('inactive'))
                <div class="alert alert-success ">
                    کاربر مورد نظر غیر فعال شد .
                </div>
                @endif
                @if(session()->has('edit'))
                <div class="alert alert-success ">
                    کاربر مورد نظر مدیر  شد .
                </div>
                @endif
                @if(session()->has('editTwo'))
                <div class="alert alert-success ">
                    مدیر مورد نظر کاربر شد .
                </div>
                @endif
                <div class="container afra-p-b-20">
            <div class="row">
                <div class="col-md-12 card  afra-p-b-20">

                    <div class="row  {{$color->title}}" >
                        <div class="col-md-1 d-none d-sm-block    border">وضعیت</div>
                        <div class="col-md-2 d-none d-sm-block  border">نام </div>
                        <div class="col-md-1 d-none d-sm-block border ">کد کاربری  </div>
                        <div class="col-md-1 d-none d-sm-block border ">موبایل  </div>
                        <div class="col-md-2 d-none d-sm-block border ">ایمیل  </div>
                        <div class="col-md-1 d-none d-sm-block border ">ip  </div>
                        <div class="col-md-1 d-none d-sm-block border ">تاریخ  </div>
                        <div class="col-md-1 d-none d-sm-block border ">سمت </div>
                        <div class="col-md-1 d-none d-sm-block border ">تغییر سمت </div>
                        <div class="col-md-1 d-none d-sm-block border ">حذف  </div>
                    </div>
                    @foreach ($users as $user)
                    <div class="row  center" >
                        <div class="col-md-1 d-none d-sm-block border">
                            @if($user->active == "1")
                            <form method="post" action="/admin/inactiveUser" >
                                @csrf
                                <input  name="id" type="hidden"  value="{{$user->id}}">
                                <button type="submit"  class="btn afra-btn-hide">
                                    <i class="fas fa-check afra-f-20 p-3 text-success"></i>
                                </button>
                            </form>
                            @else
                            <form method="post" action="/admin/activeUser" >
                                @csrf
                                <input  name="id" type="hidden"  value="{{$user->id}}">
                                <button type="submit"  class="btn afra-btn-hide">
                                    <i class="fas fa-check afra-f-20 p-3 text-danger"></i>
                                </button>
                            </form>

                            @endif
                        </div>
                        <div class="col-md-2 d-none d-sm-block border">{{$user->name}}</div>
                        <div class="col-md-1 d-none d-sm-block border">{{$user->code}}</div>
                        <div class="col-md-1 d-none d-sm-block border">{{$user->mobile}}</div>
                        <div class="col-md-2 d-none d-sm-block border">{{$user->email}}</div>
                        <div class="col-md-1 d-none d-sm-block border">{{$user->ip}}</div>
                        <div class="col-md-1 d-none d-sm-block border">{{$user->date}}</div>
                        <div class="col-md-1 d-none d-sm-block border">
                         @if($user->role == "1")
                            <b class="text-info">مدیر</b>
                            @else
                            <b class="text-success">کاربر</b>
                            @endif

                        </div>
                        <div class="col-md-1 d-none d-sm-block border center">
                            @if($user->role == "1")
                            <form method="post" action="/admin/editUserTwo" >
                                @csrf
                                <input  name="id" type="hidden"  value="{{$user->id}}">
                            <button class="btn btn-outline-success" type="submit">
                            <b>کاربر شود</b>
                            </button>
                            </form>
                            @else
                            <form method="post" action="/admin/editUser" >
                                @csrf
                                <input  name="id" type="hidden"  value="{{$user->id}}">
                                <button class="btn btn-outline-info" type="submit">
                            <b >مدیر شود</b>
                                </button>
                            </form>
                            @endif
                        </div>

                        <div class="col-md-1 d-none d-sm-block border center">
                            <form method="post" action="/admin/deleteUser" >
                                @csrf
                                <input  name="id" type="hidden"  value="{{$user->id}}">
                                <button type="submit"  class="btn afra-btn-hide">
                                    <i class="fas fa-window-close afra-f-20 p-3 text-danger"></i>
                                </button>
                            </form>

                        </div>
                        <div class="collapse   afra-w-100" id="collapseExample{{$user->id}}">
                            <div class="card card-body right">
                                <form method="post" action="/admin/editQuestion" >
                                    @csrf
                                    <input  name="id" type="hidden"  value="{{$user->id}}">
                                    <div class="form-group row ">
                                        <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('سوال'  ) }}</label>
                                        <div class="col-md-8">
                                            <input  id="title" type="text" class="form-control{{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"    value="{{$user->title}}" />
                                            @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>خطا در هنگام ویرایش اطلاعات</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description_one" class="col-md-2 col-form-label text-md-right">{{ __('پاسخ'  ) }}</label>
                                        <div class="col-md-8">
                                            <textarea rows="2" id="description_one" type="text" class="form-control{{ $errors->has('description_one') ? 'is-invalid' : '' }}" name="description_one"  >{{ $user->description_one }}</textarea>
                                            @if ($errors->has('description_one '))
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
            </div>
</div>
</div>
</div>
</div>


@endsection
