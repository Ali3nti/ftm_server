@foreach ($colors as $color) @endforeach
@foreach ($generals as $general) @endforeach

@php( $name_ans = $_POST['name_ans'])
@php( $code = $_POST['code'])
<form method="POST" action="/admin/answer_msg" enctype="multipart/form-data">
    @csrf
    <div class="row ">
        <div class="col-md-12 ">
            <input type="hidden" name="name_ans" value="{{$name_ans}}" />
            <input type="hidden" name="code" value="{{$code}}">
            <div class="form-group row">
                <label for="massage" class="col-md-3 col-form-label text-md-right">{{ __('متن پیام *') }}</label>
                <div class="col-md-6">
                    <textarea id="massage" rows="5" class="form-control{{ $errors->has('massage') ? ' is-invalid' : '' }}" name="massage" value="{{ old('massage') }}" required ></textarea>
                    @if ($errors->has('massage'))
                        <span class="invalid-feedback" role="alert">
                            <strong>ثبت متن پیام الزامی می باشد</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row ">
                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn {{$color->button}} afra-white wrn-btn">
                        {{ __('ارسال پیام ') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>