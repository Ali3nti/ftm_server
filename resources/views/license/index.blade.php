@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style')
<?php
$title =  "مجوز ها  | " .$general->title ;
$v = verta();
?>
@section('content')
<div class="container-fluid">
    <div class="row {{$color->title}}  padding-foot afra-title-img" >
        <div class="col-lg-12  " >
            <h5 class="afra-p-top5">
                <a href="/" class="afra-white"> <i class="fas fa-home"></i> صفحه اصلی /</a>   <b >    مجوز ها   </b>
            </h5>
        </div>
    </div>
{{--  --}}

<div class="row  " >
{{--  --}}
    @foreach ($licenses as $license)
    <div class="col-md-3  margin-top-bottom" >
        <div class="card" style="width: 18rem;">
            <img src="licenses/{{$license->image}}" class="card-img-top" alt="{{$general->alt}}" height="200">
            <div class="card-body" >
                <p class="card-text">
                    {{$license->title}}
                </p>
            </div>
            @if (Route::has('login'))
            @auth
            <form action="/imgView"  method="get" target="_blank">
                <input type="hidden"  name="img" value="{{$license->image}}" />
                <button type="submit"  class="btn  afra-btn-100 afra-btn-w afra-btn-b-t">مشاهده مجوز با سایز اصلی </button>
            </form>
            @else
            <button  type="button" class="btn  afra-btn-100 afra-btn-w afra-btn-b-t" data-toggle="modal" data-target="#exampleModalScrollable">مشاهده مجوز با سایز اصلی </button>

            @endauth
            @endif

        </div>
    </div>
    @endforeach
{{--  --}}
</div>

{{--  --}}
</div>


@endsection