<div class="container">

    <div class="row justify-content-center ">
        <div class="col-md-12 afra-padd-bottom  ">
            @foreach ($user_comments as $user_comment)  @endforeach
                @if($user_comment->id == $_POST['id'])
                    <h6>  <b class="afra-red"> نام و نام خانوادگی : </b>{{$user_comment->name_family}}</h6>
                    <h6>     <b class="afra-red">ایمیل  : </b>{{$user_comment->email }}</h6>
                    <h6>     <b class="afra-red">تلفن همراه : </b>{{$user_comment->mobile }}</h6>
                    <h6>     <b class="afra-red">موضوع پیام  : </b>{{$user_comment-> subject }}</h6>
                    <h6>     <b class="afra-red">متن پیام  : </b>{{ $user_comment-> massage }}</h6>
                    <h6>     <b class="afra-red">حق انتشار پیام : </b>@if($user_comment-> publish == 'on') دارد @else ندارد @endif</h6>
                    <h6>     <b class="afra-red">ساعت پیام : </b>{{  $user_comment-> time }}</h6>
                    <h6>      <b class="afra-red">تاریخ پیام : </b><a dir="ltr">{{  $user_comment->date }}</a></h6>
                    <h6>      <b class="afra-red">ای پی کاربر : </b>{{  $user_comment->ip }}</h6>
                    <hr>
                    <h6>پاسخ به کاربر  : </h6>
                    <form method="POST" action="/admin/comment_answer" >
                        @csrf
                        <input type="hidden" name="ids" value="contact">
                        <input type="hidden" name="idm" value="{{  $user_comment->id }}">
                        <textarea class="form-control" rows="5" type="hidden" name="answer" ></textarea>
                        <br>
                        <button type="submit" class="btn afra-green-b afra-white center " >پاسخ </button>
                    </form>
                    <hr>
                    <h6>   <b class="afra-red">  وضعیت پاسخ دهی : </b> {{ $user_comment->visit }}</h6>
                    <h6>   <b class="afra-red"> متن پاسخ : </b> {{ $user_comment->answer }}</h6>
                    <h6>   <b class="afra-red">ساعت پاسخ دهی : </b> {{$user_comment->time_answer}}</h6>
                    <h6>   <b class="afra-red"> تاریخ پاسخ دهی  : </b> {{$user_comment->date_answer}}</h6>
                @endif

        </div>
    </div>
</div>
