@foreach ($generals as $general)@endforeach
@foreach ($colors as $color)@endforeach
@php($title = $general->title .  "|  هوشمند سازی جایگاه های سوخت در ایران  "  )
@php($v = verta())
@extends('style')
@section('content')
    @foreach ($sliders as $slider)
            <div id="carousel-example-1z" class="carousel slide carousel-fade afra-padding-margin" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    @if($slider->active == "1")
                        <div class="carousel-item active">
                            <img id="img-slider" class="d-block w-100 img-responsive" src="slider/{{$slider->slider_img}}" alt="فرزین توانش مهرساد">
                        </div>

                        <div class="carousel-item">
                            <img id="img-slider" class="d-block w-100 img-responsive" src="slider/{{$slider->slider_img_one}}" alt="فرزین توانش مهرساد">
                        </div>

                        <div class="carousel-item">
                            <img id="img-slider" class="d-block w-100 img-responsive" src="slider/{{$slider->slider_img_two}}" alt="فرزین توانش مهرساد">
                        </div>
                        @endif
                    </div>

                    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div>
    @endforeach
    <div class="container-fluid">
    <div class="container">
    <div class="row  " >
        <div class="col-lg-12   ">
        <div class="afra-box-6"  >
            <div class="page-header" ><span class="afra-line-4 afra-red-google afra-f-11">آخرین اخبار</span></div>
             <div class="row  " >
        <div class="col-lg-12   ">
     @foreach ($ftm_news as $ftm_new)
         @if($ftm_new->active == '1' )
     <form action="/new"  method="get">
         <input type="hidden" name="id_news" value="{{$ftm_new->id}}" />
         <button type="submit"  class="afra-btn-hide  justify" >
      <img src="news/{{$ftm_new->img_one}}" class="mr-3  imgM-news p-3 d-xl-none center"  alt="FTM" />
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
                @endif
@endforeach
       <div class="row  " >
     @foreach ($fm_news as $fm_new)
               <div class="col-md-4   ">
            @if($fm_new->active == '1' )
                 <form action="/new"  method="get">
                     <input type="hidden" name="id_news" value="{{$fm_new->id}}" />
                     <button type="submit"  class="afra-btn-hide  justify" >
                         <img src="news/{{$fm_new->img_one}}" class="mr-3  imgS-news p-3 d-xl-none center" alt="FTM"  />
                         <div class="media p-3">
                             <img src="news/{{$fm_new->img_one}}" class="mr-3  imgS-news d-none d-xl-block" alt="FTM" />
                             <div class="media-body">
                                 <div class="time-right afra-gery6">
                                     {{$fm_new->date_news}} &nbsp;
                                     <i class="far fa-calendar-alt"></i>
                                 </div>
                                 <br>
                                 <p class="mt-0 {{$color->pen}} ">{{$fm_new->title}}</p>
                             </div>
                         </div>
                     </button>
                 </form>
            @endif
        </div>
           @endforeach
        </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    </div>
        {{--banner--}}
        <div class="row  " >
            <img src="banner/{{$slider->banner}}" id="img-slider" class="img-responsive" alt="{{$general->alt}}" />
        </div>


{{--video--}}
        @include('videos')



    </div>

@endsection
