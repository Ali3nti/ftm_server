@foreach ($generals as $general) @endforeach
@foreach ($colors as $color) @endforeach
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
 <base href="{{$general->link}}" />
<meta charset="utf-8">
<meta name="description" content="{{ $general->description }}"/>
<meta name="keywords" content="{{ $general->keywords_fa }}"/>
<meta name="keywords" content="{{ $general->keywords_en }}"/>
<meta property="og:description" content="{{ $general->description }}"/>
<meta property="og:title" content="{{ $general->title }}"/>
 <meta name="author" content="طاهره محرم" />
 <meta http-equiv="Content-Language" content="Fa" />
<meta property="og:locale" content="fa_IR">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $general->link }}">
<meta property="og:image" content="favicon/{{ $general->favicon }}">
<meta property="og:image:width" content="100">
<meta property="og:image:height" content="100">
<link rel="canonical" href="{{ $general->website }}">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>{{ $title }}</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
{{-- --}}
 <meta name="csrf-token" content="{{ csrf_token() }}">
<meta property="business:contact_data:company" content="{{ $general->company }}"/>
<meta property="business:contact_data:street_address" content="{{ $general->address }}"/>
<meta property="business:contact_data:locality" content="{{ $general->city }}"/>
<meta property="business:contact_data:country_name" content="{{ $general->country }}"/>
<meta property="business:contact_data:phone_number" content="{{$general->mobile }}"/>
<meta property="business:contact_data:website" content="{{ $general->website }}"/>
{{----}}
<link rel="shortcut icon" href="favicon/{{ $general->favicon }}"/>
<link rel="stylesheet" href="css/bootstrap.min.css" >
 <link rel="stylesheet" href="css/bootstrap-datepicker.min.css" />
 <link rel="stylesheet" href="css/fonts.css" >
<link rel="stylesheet" href="css/my-style.css" >
<link rel="stylesheet" href="css/my-color.css" >
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
{{-- --}}
<script src="js/jquery-2.1.4.min.js"></script>
 <script src="js/my-ajax.js"></script>
 <script src="js/city.js"></script>
</head>
<body  class="{{$color->pen}}" dir="rtl">
<div id="preloader" ></div>
<script type="text/javascript">$(document).ready(function () {$('.demo').persiaNumber();});</script>
<div class="demo">
@include('admin.header')

<div class="container-fluid" >
@yield('content')
 {{--Modal--}}
 <div class="modal" id="myModal">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header">
     <h4 class="modal-title">اطلاعات بیشتر</h4>
     <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
 <div id="showresult"></div>
    </div>
   </div>
  </div>
 </div>
 {{--end Modal --}}
</div>
</div>

<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="js/bootstrap-datepicker.fa.min.js"></script>
<script src="js/my-script.js"></script>
<script src="js/persia-number.min.js"></script>
<script type="text/javascript">document.getElementById('preloader').style.display = "none";</script>
<script>$("#datepicker4").datepicker({changeMonth: true, changeYear: true});</script>
</body>
</html>