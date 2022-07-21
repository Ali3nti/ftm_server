@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style')
@php($title =  "کلیپ های ویدئویی  | " .$general->title )
@section('content')
    <div class="container-fluid">
        <div class="row {{$color->title}}  padding-foot afra-title-img" >
            <div class="col-lg-12  " >
                <h5 class="afra-p-top5">
                    <a href="/" class="afra-white"> <i class="fas fa-home"></i> صفحه اصلی /</a>   <b >    ویدئو ها </b>
                </h5>
            </div>
        </div>
    {{--  --}}
        <div class=" afra-back-video ">
            <div  class="row   afra-p-t-b  afra-back-video afra-white"   >
                @foreach ($videos as $video)
                    @if($video->id == $_POST['id'] )
                        <div class="col-lg-8   ">
                            <video width="100%"  poster="videos/img_video/{{$video->img_video}}" class="border-gray " controlsList="nodownload" controls>
                                <source src="videos/{{$video->video}}" type="video/mp4"   >
                                <source src="videos/{{$video->video}}" type="video/ogg" >
                                Your browser does not support the video tag.
                            </video>

                        </div>
                            <div class="col-lg-4  afra-p-t-b  ">
                                <div class="p-3">
                                <h4>{{$video->title}}</h4>
                                <h5 class="afra-m-b">{{$video->description}}</h5>
                                <div class="time-left afra-gery6">{{$video->date_news}} &nbsp;<i class="far fa-calendar-alt"></i> </div>
                                <div class="time-right afra-gery6"><i class=" 	fas fa-eye"></i> {{$video->visit}}  بازدید   </div>
                                </div>
                            </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>


@endsection
