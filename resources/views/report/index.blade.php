@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style')
@php($title =  "گزارش عملکرد   | " .$general->title )
@section('content')
    <div class="container-fluid">
        <div class="row {{$color->title}}  padding-foot afra-title-img" >
            <div class="col-lg-12  " >
                <h5 class="afra-p-top5">
                    <a href="/" class="afra-white"> <i class="fas fa-home"></i> صفحه اصلی /</a>   <b >   گزارش عملکرد  </b>
                </h5>
            </div>
        </div>
    {{--  --}}
        <div class=" container">
            <div  class="row   afra-p-t-b "   >
                @foreach ($about_us as $about)
                    @if($about->group_about == "report")
                        <div class="col-md-12">
                            <div class="container2 darker">
                                <p>{{$about->title}}</p>
                                <p>{{$about->description_one}}
                                <p>{{$about->description_two}}
                                </p>
                                <span class="time-left">{{$about->date}}</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>


@endsection
