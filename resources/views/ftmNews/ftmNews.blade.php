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
        <div class="afra-box-6"  >
            <div class="page-header" ><span class="afra-line-4 afra-red-google afra-f-11"> اخبار</span></div>
             <div class="row  " >
        <div class="col-lg-12   ">
     @foreach ($ftm_news as $ftm_new)
     <form action="/new"  method="get">
         <input type="hidden" name="id_news" value="{{$ftm_new->id}}" />
         <button type="submit"  class="afra-btn-hide  justify" >
      <img src="news/{{$ftm_new->img_one}}" class="mr-3  imgM-news p-3 d-xl-none center" alt="FTM" />
            <div class="media p-3">
    <img src="news/{{$ftm_new->img_one}}" class="mr-3  img-news d-none d-xl-block" alt="FTM" />
    <div class="media-body">
        <p class="mt-0  afra-red-google">{{$ftm_new->title}}</p>
        <p  class="{{$color->pen}} ">{{$ftm_new->description_one}}</p>
    <div class="time-left afra-gery6">
        {{$ftm_new->date_news}} &nbsp;
        <i class="far fa-calendar-alt"></i>

    </div>
 </div>

</div>
</button>
</form>
@endforeach

        </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection
