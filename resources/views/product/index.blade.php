@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style')
@php($title =  " محصولات FTM   | " . $general->title )
@section('content')
    <div class="container-fluid">
        <div class="row {{$color->title}}  padding-foot afra-title-img" >
            <div class="col-md-12  " >
                <h5 class="afra-p-top5">
                    <a href="/" class="afra-white"> <i class="fas fa-home"></i> صفحه اصلی /</a>   <b >    محصولات FTM    </b>
                </h5>
            </div>
        </div>
    {{--  --}}

            <div  class="row   afra-p-t-b "   >
                @foreach ($products as $product)
                <div class="col-md-3  " >
                <div class="card" style="width: 18rem;">
                    <img src="products/{{$product->image_one}}" class="card-img-top" alt="{{$general->alt}}" height="200">
                    <div class="card-body" >
                        <p class="card-text">
                            {{$product->title}}
                        </p>
                    </div>
                    <form action="/product"  method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$product->id}}" />
                    <button  class="btn {{$color->button}} afra-btn-100 afra-btn-w">اطلاعات بیشتر</button>
                    </form>
                </div>
                </div>
                @endforeach
            </div>
    </div>
@endsection
