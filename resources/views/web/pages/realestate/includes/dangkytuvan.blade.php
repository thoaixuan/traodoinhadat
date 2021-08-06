<div class="widget widget-tuvan">
	<h6 class="widget-title widget-title-3">Đăng ký tư vấn</h6>
	<div class="widget-content">
		<form class="form-tuvan form-info bv-form" id="formAction" action="{{ route('web.contact.datLichTuVan') }}">
			<label class="input-inset form-group ">
                <i class="icon-user2"></i>
				<input name="full_name" id="full_name"  type="text" class="input" placeholder="Nhập họ tên (*)"
                @if (Auth::check())
                value="{{ user()->full_name }}"
                @endif >
			</label>
			<label class="input-inset form-group">
                <i class="icon-mail-2"></i>
				<input name="email" id="email"  type="text" class="input" placeholder="Nhập email"
                @if (Auth::check())
                value="{{ user()->email }}"
                @endif >

			</label>
			<label class="input-inset form-group ">
                <i class="icon-phone1"></i>
				<input name="phone" id="phone" type="text" class="input" placeholder="Nhập số điện thoại (*)"
                @if (Auth::check())
                value="{{ user()->phone }}"
                @endif >
                <input name="type_contact" id="type_contact" type="hidden" value="tu_van"/>
                <input name="realestate_id" id="realestate_id" type="hidden" value="{{ $data->result->id }}"/>
                <input name="link" id="link" type="hidden" value="{{getRealestateUrl( $data->result)}}"/>
                <input name="realestate_title" id="realestate_title" type="hidden" value="{{$data->result->realestate_title}}"/>
            </label>
			<label class="datetime-input-icon form-group ">
				<input title="Bạn vui lòng chọn trong 14 ngày gần nhất" style="width: 100%;" id="date" name="date" class="input" placeholder="dd / mm / yyyy" type="date">
			</label>
            <div id="alertPageJSTuVan"></div>
			<button id="sendContact" class="btn btn-3 btn170 send-request-top"> Đặt Lịch Xem</button>
		</form>
	</div>
</div>
@section('runCSS')
@parent
@endsection
@section('runJS')
@parent
<script>
	$(document).ready(function(){
	    $("#sendContact").on('click',function(e){
                AntispamJSON.url=$("#formAction").attr('action');
                AntispamJSON.form="#formAction";
                AntispamJSON.button=this;
                AntispamJSON.alertJS="#alertPageJSTuVan";
                AntispamJSON.resultMath="";
                AntispamJS(AntispamJSON);
        });
    });
</script>
@endsection
