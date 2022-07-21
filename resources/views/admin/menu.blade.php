
{{-- mySidenav --}}
<div class="col-md-2 height-100  d-none d-xl-block afra-padding-margin  afra-m-top  ">
<div  class="{{$color->background}} ">
@if (Route::has('login'))
@auth
<ul>
<li class="{{$color->pen_panel}} {{$color->back_panel}} afra-user center" >
<a class="nav-link {{$color->pen_panel}}" href="{{auth()->user()->panel}}">
    <br>
    <br>
<b  class="{{$color->title_panel}}">{{auth()->user()->name}}</b><br>
<b  class="{{$color->title_panel}}">{{auth()->user()->code}}</b><br>
</a>
</li>
</ul>
<br>
@endauth
@endif
<div id="navcontainer">
<ul class="navbar-nav mr-auto " id="nav">
<style type="text/css">.menu{{session('id')}} {background-color: #E3E3E3 ;  color: #dea84e}</style>
@foreach ($panel_admins as $panel_admin)
<li class="nav-item afra-p-t-6 afra-pading-right menu{{$panel_admin->id}}  " >
<a class="nav-link " href="{{ $panel_admin->link_panel }}">
<p class="icon-header {{$color->pen_panel}}">
<i class="{{$panel_admin->icon_panel}} {{$color->pen_panel}}"></i>
{{$title =  $panel_admin->name_panel}}

</p>
</a>
</li>
@endforeach
</ul>
</div>
</div>
</div>
{{-- end mySidenav--}}
