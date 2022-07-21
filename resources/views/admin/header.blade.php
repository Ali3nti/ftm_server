<nav  dir="ltr" class="navbar fixed-top navbar-expand-lg   afra-header-panel {{$color->back_panel}}"    >
<div class="clearfix"  >
{{--logout--}}
<a class="navbar-brand"  >

<a class="{{$color->title_panel}} logout-panel" href="{{ url('/logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
 خروج
</a>
<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
@csrf
</form>
</a>

{{--end logout--}}
</div>

{{--home for md--}}
<a href="/" class="d-none d-xl-block col-md-5  {{$color->title_panel}} ">
{{$general->company}}
</a>

{{--home for mobile--}}

<a href="/" class="d-lg-none {{$color->title_panel}}">
خانه
</a>


{{-- mySidenav --}}
<div id="mySidenav" class="sidenav {{$color->back_panel}} ">
@if (Route::has('login'))
@auth
<ul>
<li class="{{$color->title_panel}} {{$color->back_panel}} afra-user center" >
<a href="javascript:void(0)" class="closebtn " onclick="closeNav()"><b >&times;</b>  </a>
<a class="nav-link {{$color->title_panel}}" href="{{auth()->user()->panel}}">
@if(auth()->user()->img != '')
<br>
<img class="profile-panel {{$color->title_panel}}" src="users/{{auth()->user()->img}}"   />
@else
<br>
<img class="profile-panel {{$color->title_panel}}" src="users/default/profile-panel.png"   />
@endif
<br>
<b  class="{{$color->title_panel}}">{{auth()->user()->name}}   </b>
<b  class="{{$color->title_panel}}">{{auth()->user()->code_user}}   </b>
</a>
</li>
</ul>
@endauth
@endif
<ul class="navbar-nav mr-auto ">
<style type="text/css">.menu{{session('id')}} {background-color: #E3E3E3 ; color: #00415d}</style>
@foreach ($panel_admins as $panel_admin)
<li class="nav-item afra-p-t-11 afra-pading-right menu{{$panel_admin->id}}  " >
<a class="nav-link " href="{{ $panel_admin->link_panel }}">
<p class="icon-header {{$color->title_panel}}">
<i class="{{$panel_admin->icon_panel}} {{$color->title_panel}}"></i>
{{$title =  $panel_admin->name_panel}}

</p>
</a>
</li>
@endforeach
 </ul>
</div>

<span class="close-menu {{$color->title_panel}} d-lg-none afra-font-s-2"  onclick="openNav()">
<b class="d-lg-none {{$color->title_panel}} afra-title-menu">{{session('name_panel')}}</b>
&#9776;

</span>
{{-- end mySidenav--}}

{{--menu hidden for mobail--}}
<div class="collapse navbar-collapse" id="navbarSupportedContent" dir="rtl">
<ul class="navbar-nav mr-auto  {{$color->title_panel}}">
<i class="fas fa-unlock-alt icon-header {{$color->title_panel}} afra-p-r-l" ></i>     پنل مدیریتی     <b class="afra-p-r-l">|</b>
{{session('name_panel')}}
</ul>
</div>
{{-- end menu hidden for mobail--}}

</nav>
