@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style')
@php($title =  " FTM در یک نگاه    | " .$general->title )
@section('content')
    <div class="container-fluid">
        <div class="row {{$color->title}}  padding-foot afra-title-img" >
            <div class="col-lg-12  " >
                <h5 class="afra-p-top5">
                    <a href="/" class="afra-white"> <i class="fas fa-home"></i> صفحه اصلی /</a>   <b >   FTM در یک نگاه    </b>
                </h5>
            </div>
        </div>
    {{--  --}}
        <div class="container ">
            <div  class="row   afra-p-t-b "   >
                <div class="afra-box" >
                    <br>
                    @foreach ($about_us as $about)
                    @if($about->group_about == "glance")
                    <h5 class="afra-green-google">{{$about->title}}</h5>
                    <h6 class="afra-text">{{$about->description_one}}</h6>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection
