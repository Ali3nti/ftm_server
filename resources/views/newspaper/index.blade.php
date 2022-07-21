@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style')
@php($title =  "FTM در رسانه ها   | " .$general->title )
@section('content')
    <div class="container-fluid">
        <div class="row {{$color->title}}  padding-foot afra-title-img" >
            <div class="col-lg-12  " >
                <h5 class="afra-p-top5">
                    <a href="/" class="afra-white"> <i class="fas fa-home"></i> صفحه اصلی /</a>   <b >    FTM در رسانه ها   </b>
                </h5>
            </div>
        </div>
{{--  --}}
        <div class="container ">
            <div  class="row   afra-p-t-b  "   >
                @foreach ($newspapers as $newspaper)
                    <div class="col-md-12">
                        <div class="container2 darker">
                            <img src="users/default/newspaper.jpg"  class="right" style="width:100%;" alt="{{$general->alt}}">
                            <p>{{$newspaper->title}}</p>
                            <p>{{$newspaper->subject}}
                                (    <a href="{{$newspaper->links}}" target="_blank">لینک خبر </a> )
                            </p>
                            <span class="time-left">{{$newspaper->date}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
{{--  --}}
    </div>


@endsection
