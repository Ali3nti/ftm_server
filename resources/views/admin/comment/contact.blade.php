<div class="container">
    @if(session()->has('delete'))
        <div class="alert alert-success ">
            پیام با موفقیت حذف شد .
        </div>
    @endif
    <div class="row justify-content-center ">
        <div class="col-md-12 afra-padd-bottom card ">
            <div class="row p-2 border m-1  afra-box-link-d  afra-f-14 center">
                <div class="col-md-2 ">نام و نام خانوادگی</div>
                <div class="col-md-2 ">تلفن همراه</div>
                <div class="col-md-2 ">موضوع</div>
                <div class="col-md-2 ">تاریخ</div>
                <div class="col-md-1 ">بازدید</div>
                <div class="col-md-2 ">متن پیام و پاسخ</div>
                <div class="col-md-1 ">حذف</div>
            </div>
            @foreach ($contact_us as $contact)
                <div class="row p-2 border m-1 center afra-f-14">
                    <div class="col-md-2 ">{{$contact->name_family}}</div>
                    <div class="col-md-2 ">{{$contact->mobile}}</div>
                    <div class="col-md-2 ">{{$contact->subject}}</div>
                    <div class="col-md-2 ">{{$contact->date}}</div>
                    <div class="col-md-1 ">{{$contact->visit}}</div>
                    <div class="col-md-2 ">
                        <form method="POST" action="" >
                            @csrf
                            <input type="hidden" name="id" value="{{$contact->id}}">
                            <button type="button"  data-toggle="modal" data-target="#myModal"
                                    class="btn afra-green-b afra-white" onClick="formget(this.form,'/admin/contact_message');">پاسخ </button>
                        </form>
                    </div>
                    <div class="col-md-1 ">
                        <form method="post" action="/admin/delete_contact" >
                            @csrf
                            <input  name="id" type="hidden"  value="{{$contact->id}}">
                            <input  name="ids" type="hidden"  value="contact">
                            <button type="submit"  class="btn afra-red-b afra-white">حذف</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>