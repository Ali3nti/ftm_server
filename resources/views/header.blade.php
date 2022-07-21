<nav class="navbar navbar-expand-lg  afra-header {{$color->background}}" dir="ltr">
    <a class="navbar-brand" href="/">
        <img class="afra-logo" src="logo/{{$general->logo}}" alt="FTM"/>
        <span class="divider "></span>
    </a>
    <div class="clearfix"  >
        <ul class="d-lg-none float-xl-righ" dir="rtl">
            @if (Route::has('login'))
                @auth
                    @switch (auth()->user()->role)
                        @case(1)
                        <li class="nav-item afra-p-t-11 {{$color->main_one}}">
                            <a class="nav-link {{$color->main_one}}" href="{{auth()->user()->panel}}">
                                <i class="fas fa-unlock-alt icon-header {{$color->icon}}" ></i>
                                <b  class="{{$color->main_one}}">{{auth()->user()->name}}   </b>
                            </a>
                        </li>
                        @break
                        @case(2)
                      <li class="nav-item afra-p-t-11 dropdown {{$color->main_one}}">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle {{$color->main_one}}" href="{{auth()->user()->panel}}"   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-unlock-alt icon-header {{$color->icon}}"></i>
                                <b  class="{{$color->main_one}}">   {{auth()->user()->name}}</b>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                    خروج
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @break

                    @endswitch
                @else
                    <li class="nav-item afra-p-t-11">
                        <a class="nav-link icon-header {{$color->main_one}}" href="{{ route('login') }}">
                            <i class="fas fa-user {{$color->icon}}"></i>
                            <b  class="{{$color->main_one}}">    ورود        </b>

                        </a>
                    </li>
                @endauth
            @endif
        </ul>
    </div>
    {{-- mySidenav --}}
    <div id="mySidenav" class="sidenav {{$color->back_panel}}">
        <a href="javascript:void(0)" class="closebtn " onclick="closeNav()"><b class="{{$color->icone}}">&times;</b>  </a>
        <p class="afra-lg"></p>
        <ul class="navbar-nav mr-auto ">
            <li class="nav-item afra-p-t-11 afra-pading-right">
                <p class="{{$color->title_panel}} center">{{$general->title}}</p>

            </li>
            <div class="afra-border {{$color->title_panel}}"></div>
            @foreach ($headers as $header)
                @if($header->name_menu == "اخبار" ||  $header->name_menu == "تماس با ما" ||  $header->name_menu == "صفحه اصلی")
                    {{--<li class="nav-item afra-p-t-5 afra-pading-right">--}}
                        {{--<a class="nav-link " href="{{$header->link_menu}}">--}}
                            {{--<p class="icon-header {{$color->title_panel}}">--}}
                                {{--<i class="{{$header->icon_menu}} {{$color->title_panel}}"></i>--}}
                                {{--{{$header->name_menu}}--}}
                            {{--</p>--}}
                        {{--</a>--}}

                    <li class="nav-item  afra-pading-right">
                        <div class="dropdown" >
                            <a class="btn afra-btn-hide   right"   href="{{$header->link_menu}}">
                                <b class="{{$color->title_panel}} afra-b-weight afra-f-17">
                                    <i class="{{$header->icon_menu}} {{$color->title_panel}}"></i>
                                    {{$header->name_menu}}
                                </b>
                            </a>
                        </div>
                    </li>
                @else
                    <li class="nav-item  afra-pading-right">
                    <div class="dropdown" >
                        <a class="btn afra-btn-hide dropdown-toggle  right"  role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <b class="{{$color->title_panel}} afra-b-weight afra-f-17">
                                <i class="{{$header->icon_menu}} {{$color->title_panel}}"></i>
                                {{$header->name_menu}}
                            </b>
                        </a>
                        <div class="dropdown-menu afra-f-11"   dir="rtl">
                            <a class=" afra-f-11" href="{{$header->menu_one_link}}"><b class="afra-f-14">{{$header->menu_one}}</b></a>
                            <a class=" afra-f-11" href="{{$header->menu_two_link}}"><b class="afra-f-14">{{$header->menu_two}}</b></a>
                            <a class=" afra-f-11" href="{{$header->menu_three_link}}"><b class="afra-f-14">{{$header->menu_three}}</b></a>
                            <a class=" afra-f-11" href="{{$header->menu_four_link}}"><b class="afra-f-14">{{$header->menu_four}}</b></a>
                            <a class="afra-f-11" href="{{$header->menu_five_link}}"><b class="afra-f-14">{{$header->menu_five}}</b></a>
                        </div>
                    </div>
                    </li>

                @endif
            @endforeach
        </ul>
    </div>
    <span class="close-menu {{$color->main_one}} d-lg-none afra-font-s-2"  onclick="openNav()"><b class="afra-f-14">منو</b> &#9776; </span>
    {{-- end mySidenav--}}

    <div class="collapse navbar-collapse" id="navbarSupportedContent" dir="rtl">
        <ul class="navbar-nav mr-auto ">

            @if (Route::has('login'))
                @auth
                    @switch (auth()->user()->role)
                        @case(1)
                        <li class="nav-item afra-p-t-11 {{$color->main_one}}">
                            <a class="nav-link {{$color->main_one}}" href="{{auth()->user()->panel}}">
                                <i class="fas fa-unlock-alt icon-header {{$color->icon}}" ></i>
                                <b  class="{{$color->main_one}}">{{auth()->user()->name}}   </b>
                            </a>
                        </li>
                        @break
                        @case(2)
                        <li class="nav-item afra-p-t-11 dropdown {{$color->main_one}}">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle {{$color->main_one}}" href="{{auth()->user()->panel}}"   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-unlock-alt icon-header {{$color->main_one}}"></i>
                                <b  class="{{$color->main_one}}">   {{auth()->user()->name}}</b>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                    خروج
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @break

                    @endswitch
                @else
                    <li class="nav-item afra-p-t-11">
                        <a class="nav-link icon-header {{$color->main_one}}" href="{{ route('login') }}">
                            <i class="fas fa-user {{$color->icon}}"></i>
                            <b  class="{{$color->main_one}}">    ورود |       </b>

                        </a>
                    </li>
                @endauth
            @endif
            @foreach ($headers as $header)
                @if($header->name_menu == "اخبار" ||  $header->name_menu == "تماس با ما" ||  $header->name_menu == "صفحه اصلی")
                        <div class="dropdown afra-p-t-6" dir="ltr">
                            <a href="{{$header->link_menu}}" class="btn afra-btn-hide   dropdown-hover {{$color->icon}}" href="#" >
                                <b class="{{$color->main_one}} afra-b-weight menu-hover">{{$header->name_menu}}</b>
                            </a>
                        </div>
                    @else

                    <div class="dropdown afra-p-t-6" dir="ltr">
                        <a class="btn afra-btn-hide dropdown-toggle  dropdown-hover {{$color->icon}}" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <b class="{{$color->main_one}} afra-b-weight menu-hover">{{$header->name_menu}}</b>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"  dir="rtl">
                            <a class="dropdown-item menu-hover-two" href="{{$header->menu_one_link}}">{{$header->menu_one}}</a>
                            <a class="dropdown-item menu-hover-two" href="{{$header->menu_two_link}}">{{$header->menu_two}}</a>
                            <a class="dropdown-item menu-hover-two" href="{{$header->menu_three_link}}">{{$header->menu_three}}</a>
                            <a class="dropdown-item menu-hover-two" href="{{$header->menu_four_link}}">{{$header->menu_four}}</a>
                            <a class="dropdown-item menu-hover-two" href="{{$header->menu_five_link}}">{{$header->menu_five}}</a>
                        </div>
                    </div>

                    @endif
            @endforeach
        </ul>    </div>
</nav>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "80%";
    }


    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
