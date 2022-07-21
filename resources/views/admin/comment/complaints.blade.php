<div class="container">
    @if(session()->has('delete'))
        <div class="alert alert-success ">
            پیام با موفقیت حذف شد .
        </div>
    @endif
    <div class="row justify-content-center ">
        <div class="col-md-12 afra-padd-bottom card ">
            <div class="row p-2 border m-1  afra-box-link-e  afra-f-14 center">
                <div class="col-md-2 ">نام و نام خانوادگی</div>
                <div class="col-md-2 ">تلفن همراه</div>
                <div class="col-md-2 ">موضوع</div>
                <div class="col-md-2 ">تاریخ</div>
                <div class="col-md-1 ">بازدید</div>
                <div class="col-md-2 ">متن پیام و پاسخ</div>
                <div class="col-md-1 ">حذف</div>
            </div>
            @foreach ($complaints as $complaint)
                <div class="row p-2 border m-1 center afra-f-14">
                    <div class="col-md-2 ">{{$complaint->name_family}}</div>
                    <div class="col-md-2 ">{{$complaint->mobile}}</div>
                    <div class="col-md-2 ">{{$complaint->subject}}</div>
                    <div class="col-md-2 ">{{$complaint->date}}</div>
                    <div class="col-md-1 ">{{$complaint->visit}}</div>
                    <div class="col-md-2 ">
                    <form method="POST" action="" >
                        @csrf
                        <input type="hidden" name="id" value="{{$complaint->id}}">
                        <button type="button"  data-toggle="modal" data-target="#myModal"
                                class="btn afra-green-b afra-white" onClick="formget(this.form,'/admin/complaint_message');">پاسخ </button>
                    </form>
                </div>
                    <div class="col-md-1 ">
                        <form method="post" action="/admin/delete_complaint" >
                            @csrf
                            <input  name="id" type="hidden"  value="{{$complaint->id}}">
                            <input  name="ids" type="hidden"  value="complaint">
                            <button type="submit"  class="btn afra-red-b afra-white">حذف</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>