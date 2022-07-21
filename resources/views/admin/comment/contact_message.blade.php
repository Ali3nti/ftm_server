<div class="container">
    @if(session()->has('delete'))
        <div class="alert alert-success ">
            پیام با موفقیت حذف شد .
        </div>
    @endif
    <div class="row justify-content-center ">
        <div class="col-md-12 afra-padd-bottom  ">

            @foreach ($contact_us as $contact) @endforeach
                @if($contact->id == $_POST['id'])
                    <h6>  <b class="afra-red"> نام و نام خانوادگی : </b>{{$contact->name_family}}</h6>
                    <h6>     <b class="afra-red">ایمیل  : </b>{{$contact->email }}</h6>
                    <h6>     <b class="afra-red">تلفن همراه : </b>{{$contact->mobile }}</h6>
                    <h6>     <b class="afra-red">موضوع پیام  : </b>{{$contact-> subject }}</h6>
                    <h6>     <b class="afra-red">متن پیام  : </b>{{ $contact-> massage }}</h6>
                    <h6>     <b class="afra-red">حق انتشار پیام : </b>@if($contact-> publish == 'on') دارد @else ندارد @endif</h6>
                    <h6>     <b class="afra-red">ساعت پیام : </b>{{  $contact-> time }}</h6>
                    <h6>      <b class="afra-red">تاریخ پیام : </b><a dir="ltr">{{  $contact->date }}</a></h6>
                    <h6>      <b class="afra-red">ای پی کاربر : </b>{{  $contact->ip }}</h6>
                    <hr>
                    <h6>پاسخ به کاربر  : </h6>
                    <form method="POST" action="/admin/contact_answer" >
                        @csrf
                        <input type="hidden" name="ids" value="comment">
                        <input type="hidden" name="idm" value="{{  $contact->id }}">
                        <textarea class="form-control" rows="5" type="hidden" name="answer" ></textarea>
                        <br>
                        <button type="submit" class="btn afra-green-b afra-white center " >پاسخ </button>
                    </form>
                    <hr>
                    <h6>   <b class="afra-red">  وضعیت پاسخ دهی : </b> {{ $contact->visit }}</h6>
                    <h6>   <b class="afra-red"> متن پاسخ : </b> {{ $contact->answer }}</h6>
                    <h6>   <b class="afra-red">ساعت پاسخ دهی : </b> {{$contact->time_answer}}</h6>
                    <h6>   <b class="afra-red"> تاریخ پاسخ دهی  : </b> {{$contact->date_answer}}</h6>
                @endif

        </div>
    </div>
</div>
