@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style')
<?php
$title =  "اخبار  | " .$general->title ;
$v = verta();
?>
@section('content')
    <div class="container-fluid">
    <div class="row {{$color->title}}  padding-foot afra-title-img" >
        <div class="col-lg-12  " >
            <h5 class="afra-p-top5">
                <a href="/" class="afra-white"> <i class="fas fa-home"></i> صفحه اصلی /</a>   <b >    اخبار </b>
            </h5>
        </div>
    </div>
    {{--  --}}
      <div class="container">
        <div class="row  " >
                <div class="col-lg-12   ">
                <div class="afra-box"  >

                @foreach ($ftm_news as $ftm_new)
                @if($ftm_new->id == $_GET['id_news'])
                <div class="page-header" ><span class="afra-line-4 afra-red-google afra-f-15">{{$ftm_new->title}}</span></div>
                 <div class="row  " >
                <div class="col-lg-12   ">
                    <img src="news/{{$ftm_new->img_one}}" class="mr-3 p-3  imgB-news " alt="FTM" />
                    <div class="media-body">
                <p class="afra-red-google p-2">{{$ftm_new->description_one}}</p>
                <p class="{{$color->pen}} p-2 afra-line-height">{{$ftm_new->description_two}}</p>
        <div class="time-left afra-gery6">
                {{$ftm_new->date_news}} &nbsp;
                <i class="far fa-calendar-alt"></i>

        </div>


</div>
@if(!empty($ftm_new->img_two))
<img src="news/{{$ftm_new->img_two}}" class="mr-3 p-3  imgB-news " alt="FTM" />
@endif

@if(!empty($ftm_new->img_three))
<img src="news/{{$ftm_new->img_three}}" class="mr-3 p-3  imgB-news " alt="FTM" />
@endif
</div>
</div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
