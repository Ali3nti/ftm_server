@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style')
<?php
$title =  "قوانین و مقررات  | " .$general->title ;
$v = verta();
?>
@section('content')
    <div class="container-fluid">
    <div class="row {{$color->title}}  padding-foot afra-title-img" >
        <div class="col-lg-12  " >
            <h5 class="afra-p-top5">
                <a href="/" class="afra-white"> <i class="fas fa-home"></i> صفحه اصلی /</a>   <b >    قوانین و مقررات  </b>
            </h5>
        </div>
    </div>
        {{--  --}}
        <div class="row  " >
            <div class="col-lg-10   offset-md-1">
<div class="afra-box" >
    <br>
    <h5 class="afra-title {{$color->main_one}}">
        کاربر گرامی لطفا قوانین و مقررات فزرین توانش مهرساد   را با دقت مطالعه کرده و در موقع ثبت نام به کار گرفته شود </h5><br><br>
        @foreach ($rules as $rule)
            <h5 class="afra-text-two afra-blue-google">
                {{$rule->title}}
            </h5>
<h6 class="afra-text-two">

    <i class="fa fa-circle {{$color->icon}} icon-footer" ></i>  {{$rule->description_one}}</h6>@endforeach</div>
    </div>
</div>
</div>
@endsection
