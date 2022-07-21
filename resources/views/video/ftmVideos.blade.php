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
                    @if($video->active == '1' )
                        <div class="col-lg-3   " >
                            <div class="img-video">
                                <form action="/video"  method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$video->id}}" />
                                    <img src="videos/img_video/{{$video->img_video}}" alt="FTM"  class="img-responsive video-img-2" width="100%">
                                    <div class="tex-video" ><p>{{$video->title}}</p></div>
                                    <button type="submit"  class="afra-btn-hide afra-white " >
                                        <div class="icon-video pointer" ><i class="fas fa-play-circle"> </i></div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>


@endsection
