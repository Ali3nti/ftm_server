@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach
@extends('style')
@php($title =  "اعضای هیئت مدیره و مدیر عامل    | " .$general->title )
@section('content')
    <div class="container-fluid">
        <div class="row {{$color->title}}  padding-foot afra-title-img" >
            <div class="col-lg-12  " >
                <h5 class="afra-p-top5">
                    <a href="/" class="afra-white"> <i class="fas fa-home"></i> صفحه اصلی /</a>   <b >    اعضای هیئت مدیره و مدیر عامل  </b>
                </h5>
            </div>
        </div>
    {{--  --}}
        <style >
            .main-timeline{
                position: relative;
            }
            .main-timeline:after{
                content: '';
                display: block;
                clear: both;
            }
            .main-timeline .timeline{
                width: 50%;
                margin: 0 10px 30px 0;
                float: left;
            }
            .main-timeline .timeline-content{
                color: #fff;
                text-align: right;
                display: block;
                position: relative;
                z-index: 1;
            }
            .main-timeline .timeline-content:hover{ text-decoration: none; }
            .main-timeline .timeline-content:before,
            .main-timeline .timeline-content:after{
                content: "";
                background: #445268;
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                right: 0;
                z-index: -1;
                -webkit-clip-path: polygon(10% 0, 100% 10%, 95% 100%, 0 90%);
                clip-path: polygon(10% 0, 100% 10%, 95% 100%, 0 90%);
            }
            .main-timeline .timeline-content:after{
                background-color: #000;
                z-index: -2;
                -webkit-clip-path: polygon(10% 10%, 95% 0, 90% 90%, 5% 100%);
                clip-path: polygon(10% 10%, 95% 0, 90% 90%, 5% 100%);
            }
            .main-timeline .timeline-icon{
                color: #fff;
                background-color: #445268;
                font-size: 40px;
                text-align: center;
                line-height: 10px;
                height: 100px;
                width: 100px;
                border-radius: 50%;
                box-shadow: 0 0 7px #000, 0 0 0 22px #fff,0 0 10px 20px #000;
                display: block;
                transform: translateY(-50%);
                position: absolute;
                top: 60%;
                right: -45px;
            }
            .main-timeline .inner-content{ padding: 30px 85px 40px 40px; }
            .main-timeline .title{
                font-size: 20px;
                font-weight: 800;
                text-transform: uppercase;
                margin: 0 0 10px;
            }
            .main-timeline .description{
                font-size: 15px;
                margin: 0;
            }
            .main-timeline .timeline:nth-child(even){
                float: right;
                margin: 0 0 30px 10px;
            }
            .main-timeline .timeline:nth-child(even) .timeline-content{ text-align: left; }
            .main-timeline .timeline:nth-child(even) .timeline-content:before,
            .main-timeline .timeline:nth-child(even) .timeline-content:after{
                transform: rotateY(180deg);
            }
            .main-timeline .timeline:nth-child(even) .timeline-icon{
                left: -45px;
                right: auto;
            }
            .main-timeline .timeline:nth-child(even) .inner-content{ padding: 30px 40px 40px 85px; }
            .main-timeline .timeline:nth-child(4n+2) .timeline-content:before,
            .main-timeline .timeline:nth-child(4n+2) .timeline-icon{
                background-color: #dea84e;
            }
            .main-timeline .timeline:nth-child(4n+3) .timeline-content:before,
            .main-timeline .timeline:nth-child(4n+3) .timeline-icon{
                background-color: #004a84;
            }
            .main-timeline .timeline:nth-child(4n+4) .timeline-content:before,
            .main-timeline .timeline:nth-child(4n+4) .timeline-icon{
                background-color: #94b2e2;
            }
            @media screen and (max-width:767px){
                .main-timeline .timeline{
                    width: 100%;
                    margin: 0 0 40px;
                }
                .main-timeline .timeline-content,
                .main-timeline .timeline:nth-child(even) .timeline-content{
                    text-align: left;
                    margin: 0 0 0 40px;
                }
                .main-timeline .timeline-content:before,
                .main-timeline .timeline-content:after{
                    transform: rotateY(180deg);
                }
                .main-timeline .timeline-content:before{
                    -webkit-clip-path: polygon(3% 0, 100% 5%, 97% 100%, 0 95%);
                    clip-path: polygon(3% 0, 100% 5%, 97% 100%, 0 95%);
                }
                .main-timeline .timeline-icon,
                .main-timeline .timeline:nth-child(even) .timeline-icon{
                    font-size: 30px;
                    line-height: 60px;
                    height: 60px;
                    width: 60px;
                    box-shadow: 0 0 5px #000, 0 0 0 10px #fff,0 0 10px 7px #000;
                    right: auto;
                    left: -30px;
                    top: 50%;
                }
                .main-timeline .inner-content,
                .main-timeline .timeline:nth-child(even) .inner-content{
                    padding: 30px 20px 40px 50px;
                }
                .main-timeline .title{ font-size: 18px; }
            }
        </style>
        <div class="container afra-p-t-b" dir="ltr">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-timeline">
                        @foreach ($about_us as $about)
                        @if($about->group_about == "manager")
                        <div class="timeline">
                            <a href="#" class="timeline-content">
                                @if(!empty($about->image_one))
                                <img class="timeline-icon" src="managers/{{$about->image_one}}"  alt="{{$general->alt}}" width="100">
                              @else
                                <img class="timeline-icon" src="users/default/profile-panel.png"  alt="{{$general->alt}}" width="100">
                                @endif
                                <div class="inner-content">
                                    <h3 class="title">{{$about->title}}</h3>
                                    <p class="description">
                                        {{$about->description_one}}
                                    </p>
                                    <p class="description">
                                        {{$about->description_two}}
                                    </p>
                                </div>
                            </a>
                        </div>
                        @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
