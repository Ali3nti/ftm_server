@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style')
@php($title =  "گالری تصاویر   | " .$general->title )
@section('content')
    <div class="container-fluid">
        <div class="row {{$color->title}}  padding-foot afra-title-img" >
            <div class="col-lg-12  " >
                <h5 class="afra-p-top5">
                    <a href="/" class="afra-white"> <i class="fas fa-home"></i> صفحه اصلی /</a>   <b >    گالری تصاویر </b>
                </h5>
            </div>
        </div>
    {{--  --}}
        <div class=" afra-back-video ">
            <div  class="row   afra-p-t-b  afra-back-video afra-white"   >
                @foreach ($images as $image)

                <div class="col-md-3  afra-p-t-b " >
                    <form action="/image"  method="post">
                        @csrf
                        <input type="hidden" name="group_img" value="{{$image->group_img}}">
                    <button type="submit"  class="afra-btn-hide afra-white " >
                    <div class="img-video">
                        <img src="dummy/dummy.png" alt="FTM"  class="img-responsive video-img-2" width="100%">
                        <div class="tex-video" >
                            مشاهده تمامی تصاویر گروه :
                            <p>{{$image->group_img}}</p>
                        </div>
                        <div class="icon-video pointer" ><i class="fas fa-images"> </i></div>
                    </div>
                    </button>
                    </form>
                </div>


                @endforeach
            </div>
        </div>
    </div>


@endsection
