@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style')
@php($title =  " سوالات متداول  | " . $general->title )
@php($v = verta())
@section('content')
    <div class="container-fluid">
    <div class="row   padding-foot afra-title-img " >
        <div class="col-lg-12  " >
            <h5 class="afra-p-t-15">
                <a href="/" class="afra-white"> <i class="fas fa-home"></i><b> صفحه اصلی /</b></a>   <b >  سوالات متداول </b>
            </h5>
        </div>
    </div>
    {{--  --}}
    <div class="row  " >
        <div class="col-lg-10  offset-md-1">
            <div class="afra-box" >
                <br>
                @foreach ($questions as $question)
                    <h5 class="afra-green-google"><i class="fas fa-question  icon-footer afra-green-google" ></i>  {{$question->title}}</h5>
                    <h6 class="afra-text">{{$question->description_one}}</h6>
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection