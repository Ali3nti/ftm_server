@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($images as $image)
                @if($image->id == $_POST['id'])
            <div class="carousel-item active ">
                <img width="100%"  src="images/{{$image->image}}" alt="{{$general->alt}}" >
            </div>
                @endif
            @endforeach
            @foreach ($images as $image)
                @if($image->group_img == $_POST['group_img'])
            <div class="carousel-item " >
                <img width="100%"  src="images/{{$image->image}}" alt="{{$general->alt}}" >
            </div>
                @endif
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


