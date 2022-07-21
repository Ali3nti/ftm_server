@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style')
<?php
$title =  "درباره ما  | " .$general->title ;
$v = verta();
?>
@section('content')
    <div class="row {{$color->title}}  padding-foot afra-title-img" >
        <div class="col-lg-12  " >
            <h5 class="afra-p-top5">
             <a href="/" class="afra-white"> <i class="fas fa-home"></i> صفحه اصلی /</a>   <b >    درباره ما</b>
            </h5>
        </div>
    </div>
    {{--  --}}
    <div class="row  " >
        <div class="col-lg-10  offset-md-1">
            <div class="afra-box" >
                <br>
                @foreach ($about_us as $about)
                    <h5>{{$about->title}}</h5>
                    <h6 class="afra-text">{{$about->description_one}}</h6>
                @endforeach
            </div>
        </div>
    </div>
@endsection
