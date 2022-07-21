@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style')
@php($title =  " گالری تصاویر FTM  | " . $general->title )
@section('content')
    <div class="container-fluid">
        <div class="row {{$color->title}}  padding-foot afra-title-img" >
            <div class="col-md-12  " >
                <h5 class="afra-p-top5">
                    <a href="/" class="afra-white"> <i class="fas fa-home"></i> صفحه اصلی /</a> <a href="/ftmImages" class="afra-white">   گالری تصاویر / </a> <b >  تصاویر {{$_POST['group_img']}}    </b>
                </h5>
            </div>
        </div>
    {{--  --}}
        <div class="row p-3">
        @foreach ($images as $image)
            @if($image->group_img == $_POST['group_img'])
                    <div class="col-md-3 afra-p-t-b image-hover" >
                        <form action=""  method="post">
                        @csrf
                            <input type="hidden" name="group_img" value="{{$image->group_img}}">
                            <input type="hidden" name="id" value="{{$image->id}}">
                            <button type="button" class="btn afra-btn-hide afra-btn-100" data-toggle="modal" data-target=".bd-example-modal-xl"
                                    onClick="formget(this.form,'/gallery');">

                    <img class="image" src="images/{{$image->image}}" alt="{{$general->alt}}"  width="100%" height="200">

                    <div class="middle">
                        <div class="text">
                            {{$image->title}}
                            <br>
                            {{$image->description}}
                            <br>
                            <div class="time-left afra-gery6">
                                {{$image->date}}
                            </div>
                        </div>
                    </div>

                    </button>

                    </form>

</div>



            @endif
        @endforeach
    </div>
        <div  class=" modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" >
                <div class="modal-content">
                    <div id="showresult"></div>
                </div>
            </div>
        </div>

        {{--  --}}
    </div>
@endsection
