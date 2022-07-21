
<div class="row {{$color->back_footer}} {{$color->pen_footer}} " >
    <div class="shape-top "></div>
    <div class="col-md-3 padding-foot" >
        <p class="title-footer" > {{$footer->title_footer}} </p>
        <p class="line-footer" >
            <i class="fas fa-angle-left {{$color->icon}} icon-footer" ></i>   <a href="{{('/contactUs')}}" class="{{$color->pen_footer}}"> ارتباط با ما  </a><br>
            <i class="fas fa-angle-left {{$color->icon}} icon-footer" ></i>   <a href="{{('/questions')}}" class="{{$color->pen_footer}}"> سوالات متداول </a><br>
            <i class="fas fa-angle-left {{$color->icon}} icon-footer" ></i>   <a href="{{('/rule')}}" class="{{$color->pen_footer}}"> قوانین و مقررات  </a><br>
            <i class="fas fa-angle-left {{$color->icon}} icon-footer" ></i>   <a href="{{('/complaint')}}" class="{{$color->pen_footer}}"> ثبت شکایات  </a><br>
            <br>
        
            <br>

        </p>
    </div>
    <div class="col-md-2 padding-foot" >
        <p class="title-footer"> {{$footer->title_footer_one}} </p>
        <p class="line-footer" >
            <i class="fas fa-angle-left {{$color->icon}} icon-footer " ></i>   <a href="{{ route('login') }}"  class="{{$color->pen_footer}}">ورود کاربر  </a><br>
            <i class="fas fa-angle-left {{$color->icon}} icon-footer" ></i>   <a href="{{ route('register') }}" class="{{$color->pen_footer}}"> ثبت نام کاربر  </a><br>
            <i class="fas fa-angle-left {{$color->icon}} icon-footer" ></i>   <a href="" class="{{$color->pen_footer}}">بازیابی رمز عبور </a><br><br><br>
        </p>
    </div>
   

    <div class="col-md-4 padding-foot" >
        <p class="title-footer"> {{$footer->title_footer_three}} </p>
        <p class="line-footer" >
            <i class="fas fa-map-marker-alt icon-footer {{$color->icon}}" ></i>   آدرس :   {{ $general->address}}      کد پستی :  ({{ $general->postal_code}} )<br>
            <i class="far fa-envelope icon-footer {{$color->icon}}" ></i>  ایمیل  :     {{ $general->email}}   <br>
            <i class="fas fa-phone icon-footer {{$color->icon}}" ></i>    تلفن :  {{ $general->telephone}} <br>

        </p>
        <div class="afra-p-t ">
            <a href="{{$footer->inst_gram}}" target="_blank"><i class="fab fa-instagram" id="link"></i></a>
            <a href="{{$footer->whats_app}}" target="_blank"><i class="fab fa-whatsapp" id="link"></i></a>
            <a href="{{$footer->telegram}}" target="_blank"><i class="fab fa-telegram" id="link"></i></a>
            <a href="{{$footer->facebook}}" target="_blank"><i class="fab fa-facebook-square" id="link"></i></a>
            <a href="{{$footer->twitter}}" target="_blank"><i class="fab fa-twitter" id="link"></i></a>
            <a href="{{$footer->inst_gram}}" target="_blank"><i class="fab fa-android" id="link"></i></a>
            <a href="{{$footer->whats_app}}" target="_blank"><i class="fab fa-apple" id="link"></i></a>
        </div>

    </div>
      <div class="col-md-2 padding-foot" >
    
<script type='text/javascript' src='http://webshomar.com/rx/?counter/stat/9481/3da7e496f4f28e6633417b13845e7fdb/script.js'></script>
       
    </div>
</div>
{{-- --}}
<div class="row {{$color->back_footer_two}} {{$color->pen_footer_two}} " >
    <div class="col-md-6 right-footer right">
        <p class="copyFooter"> © | {{$footer->law_footer}}
        </p>
    </div>
    <div class="col-md-6 left-footer left">
        <p class="copyFooter">
            <a href="http://taherehmahram.ir/" target="_blank"   class="{{$color->pen_footer_two}} power-by">{{ $footer->designed_by }} </a>
        </p>
    </div>
</div>
