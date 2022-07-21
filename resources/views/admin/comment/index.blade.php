@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style_admin')
<?php
$title =  "پیام های کاربران"  ;
$v = verta();
?>
 {{session(['name_panel'=>$title])}}
 {{session(['id'=>'7'])}}
@section('content')
<div class="row   ">
{{--start menu--}}
@include('admin.menu')
{{--end menu--}}
    <div class="col-md-10   offset-md-2 afra-m-top-2">
        <div class="container">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item ">
                <a class="nav-link active p-2 {{$color->pen}} border" id="menu-one-tab" data-toggle="pill" href="#menu-one" role="tab" aria-controls="pills-home" aria-selected="true">  <p>&nbsp;  <i class='fas fa-comment afra-f-20'   ></i>  پیام های بخش تماس با ما</p> </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link p-2 {{$color->pen}} border" id="menu-two-tab" data-toggle="pill" href="#menu-two" role="tab" aria-controls="pills-profile" aria-selected="false">  <p>&nbsp;  <i class='fas fa-comment afra-f-20'   ></i>  پیام های بخش شکایات</p> </a>
            </li>
            </ul>

        </div>
        @if(session()->get("ids") == '')
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="menu-one" role="tabpanel" aria-labelledby="menu-one-tab">
                    @include('admin.comment.contact')
                </div>
                <div class="tab-pane fade" id="menu-two" role="tabpanel" aria-labelledby="menu-two-tab">
                    @include('admin.comment.complaints')
                </div>
            </div>
        @else
            <section id="content"   >
                @switch ( session()->get("ids") )
                    @case('comment')
                    @include('admin.comment.contact')
                    @break
                    @case('complaint')
                    @include('admin.comment.complaints')
                    @break
                @endswitch
            </section>
        @endif
    </div>
</div>
@endsection
