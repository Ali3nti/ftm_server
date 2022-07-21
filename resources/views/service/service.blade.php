@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style')
@php($title =  " اطلاعات خدمات FTM  | " . $general->title )
@section('content')
    <div class="container-fluid">
        <div class="row {{$color->title}}  padding-foot afra-title-img" >
            <div class="col-md-12  " >
                <h5 class="afra-p-top5">
                    <a href="/" class="afra-white"> <i class="fas fa-home"></i> صفحه اصلی /</a>   <b > اطلاعات خدمات FTM   </b>
                </h5>
            </div>
        </div>
    {{--  --}}
        <div class="container">
            <div  class="row   afra-p-t-b "   >
                @foreach ($services as $service)
                    @if($service->id == $_POST['id'])
                        <div class="row ">
                            <div class="col-md-6 center afra-m-b-4 ">
                                <div class="title1-product">
                                    <h5  >نام خدمت:
                                        <b class="afra-green"> {{$service->title}}</b>
                                    </h5>
                                 <h5>
                                    توضیحات :
                                        <b class="afra-green">({{$service->description}})</b>
                                 </h5>
                                </div>

                            </div>
                            <div class="col-md-6 center afra-m-b-4" >
                                <div class="img-magnifier-container">
                                    <img id="myimage" src="services/{{$service->image_one}}" alt="{{$general->alt}}" width="100%" height="50%">
                                </div>

                                <script>
                                    magnify("myimage", 3);
                                </script>

                            </div>
                        </div>
                        <div class="row  afra-m-top">
                            @if(!empty($service->image_two))
                                <div class="col-md-6 " >
                                    <img  src="services/{{$service->image_two}}" alt="{{$general->alt}}" width="100%">
                                </div>
                            @endif
                            @if(!empty($service->image_three))
                                    <div class="col-md-6 " >
                                        <img  src="services/{{$service->image_three}}" alt="{{$general->alt}}" width="100%" >
                                    </div>
                                @endif
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        {{--  --}}
    </div>
@endsection
