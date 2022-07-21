
<div  class="row   afra-p-t-20  afra-back-video afra-white"   >
    <div class="col-lg-10  offset-md-1  afra-p-b-20" >
        <div class="page-header" ><span class="afra-line-3 "> چند رسانه ای</span></div>
        <div class="row afra-p-t-15">
            <div class="col-lg-8   " >
                <div class="img-video">
                    @foreach ($videos as $video)
                        @if($video->active == '1' )
                            <form action="/video"  method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$video->id}}" />
                                <img src="videos/img_video/{{$video->img_video}}" alt="FTM"  class="img-responsive afra-p-b-20 video-img" width="100%"  >
                                <div class="tex-video" ><p>{{$video->title}} </p></div>
                                <button type="submit"  class="afra-btn-hide afra-white" >
                                    <div class="icon-video pointer" ><i class="fas fa-play-circle"> </i></div>
                                </button>
                            </form>
                    @endif
                    @endforeach
            </div>
            </div>
            <div class="col-lg-4   " >
                <div class="row ">
                    @foreach ($clips as $clip)
                        @if($clip->active == '1' )
                    <div class="col-lg-12   " >
                        <div class="img-video">
                            <form action="/video"  method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$clip->id}}" />
                        <img src="videos/img_video/{{$clip->img_video}}" alt="FTM"  class="img-responsive video-img-2" width="100%">
                            <div class="tex-video" ><p>{{$clip->title}}</p></div>
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

    </div>
</div>
