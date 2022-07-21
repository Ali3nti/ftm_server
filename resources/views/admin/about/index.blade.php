@foreach ($generals as $general) @endforeach
@foreach ($colors as $color) @endforeach
@foreach ($abouts as $about) @endforeach
@extends('style_admin')
@php($title =  "مدیریت  درباره ما" )

 {{session(['name_panel'=>$title])}}
 {{session(['id'=>'8'])}}
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
                    رکورد مورد نظر حذف شد .
                </div>
                @endif
                @if(session()->has('record'))
                <div class="alert alert-success ">
                    ثبت    با موفقیت انجام شد .
                </div>
                @endif
                @if(session()->has('active'))
                <div class="alert alert-success ">
                    رکورد مورد نظر فعال  شد .
                </div>
                @endif
                @if(session()->has('inactive'))
                <div class="alert alert-success ">
                    رکورد مورد نظر غیر فعال شد .
                </div>
                @endif
                    @if(session()->has('edit'))
                <div class="alert alert-success ">
                    رکورد مورد نظر ویرایش  شد .
                </div>
                @endif
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            @foreach ($headers as $header)
                                @if($header->name_menu == "درباره ما" )
                                    <li class="nav-item ">
                                        <a class="nav-link active p-2 {{$color->pen}} border" id="menu-one-tab" data-toggle="pill" href="#menu-one" role="tab" aria-controls="pills-home" aria-selected="true"> <i class="fas fa-edit afra-green"></i> {{$header->menu_one}}</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link p-2 {{$color->pen}} border" id="menu-two-tab" data-toggle="pill" href="#menu-two" role="tab" aria-controls="pills-profile" aria-selected="false"> <i class="fas fa-edit afra-green"></i> {{$header->menu_two}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link p-2 {{$color->pen}} border" id="menu-three-tab" data-toggle="pill" href="#menu-three" role="tab" aria-controls="pills-contact" aria-selected="false"> <i class="fas fa-edit afra-green"></i> {{$header->menu_three}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link p-2 {{$color->pen}} border" id="menu-four-tab" data-toggle="pill" href="#menu-four" role="tab" aria-controls="pills-contact" aria-selected="false"> <i class="fas fa-edit afra-green"></i> {{$header->menu_four}}</a>
                                    </li>
                            <li class="nav-item">
                                <a class="nav-link p-2 {{$color->pen}} border" id="menu-five-tab" data-toggle="pill" href="#menu-five" role="tab" aria-controls="pills-contact" aria-selected="false"> <i class="fas fa-edit afra-green"></i> FTM در رسانه ها</a>
                            </li>

                                @endif
                            @endforeach

                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="menu-one" role="tabpanel" aria-labelledby="menu-one-tab">
                                @include('admin.about.menuOne')
                            </div>
                            <div class="tab-pane fade" id="menu-two" role="tabpanel" aria-labelledby="menu-two-tab">
                                @include('admin.about.menuTwo')
                            </div>
                            <div class="tab-pane fade" id="menu-three" role="tabpanel" aria-labelledby="menu-three-tab">
                                @include('admin.about.menuThree')
                            </div>
                            <div class="tab-pane fade" id="menu-four" role="tabpanel" aria-labelledby="menu-four-tab">
                                @include('admin.about.menuFour')
                            </div>
                            <div class="tab-pane fade" id="menu-five" role="tabpanel" aria-labelledby="menu-four-tab">
                                @include('admin.about.menuFive')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
</div>


@endsection
