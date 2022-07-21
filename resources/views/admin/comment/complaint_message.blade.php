<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-12 afra-padd-bottom  ">
            @foreach ($complaints as $complaint)
            @if($complaint->id == $_POST['id'])
                    <h6>  <b class="afra-red"> نام و نام خانوادگی : </b>{{$complaint->name_family}}</h6>
                    <h6>     <b class="afra-red">ایمیل  : </b>{{$complaint->email }}</h6>
                    <h6>     <b class="afra-red">تلفن همراه : </b>{{$complaint->mobile }}</h6>
                    <h6>     <b class="afra-red">موضوع پیام  : </b>{{$complaint-> subject }}</h6>
                    <h6>     <b class="afra-red">متن پیام  : </b>{{ $complaint-> massage }}</h6>
                    <h6>     <b class="afra-red">حق انتشار پیام : </b>@if($complaint-> publish == 'on') دارد @else ندارد @endif</h6>
                    <h6>     <b class="afra-red">ساعت پیام : </b>{{  $complaint-> time }}</h6>
                    <h6>      <b class="afra-red">تاریخ پیام : </b><a dir="ltr">{{  $complaint->date }}</a></h6>
                    <h6>      <b class="afra-red">ای پی کاربر : </b>{{  $complaint->ip }}</h6>
            <hr>
            <h6>پاسخ به کاربر  : </h6>
              <form method="POST" action="/admin/complaint_answer" >
                @csrf
                  <input type="hidden" name="ids" value="complaint">
                  <input type="hidden" name="idm" value="{{  $complaint->id }}">
                  <textarea class="form-control" rows="5" type="hidden" name="answer" ></textarea>
                  <br>
                 <button type="submit" class="btn afra-green-b afra-white center " >پاسخ </button>
              </form>
                <hr>
                 <h6>   <b class="afra-red">  وضعیت پاسخ دهی : </b> {{ $complaint->visit }}</h6>
                 <h6>   <b class="afra-red"> متن پاسخ : </b> {{ $complaint->answer }}</h6>
                 <h6>   <b class="afra-red">ساعت پاسخ دهی : </b> {{$complaint->time_answer}}</h6>
                 <h6>   <b class="afra-red"> تاریخ پاسخ دهی  : </b> {{$complaint->date_answer}}</h6>

               @endif
            @endforeach
        </div>
        </div>
        </div>
