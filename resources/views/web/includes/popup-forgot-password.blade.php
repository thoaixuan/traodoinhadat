<div class="modal md-popup md-login" id="popup-forgot-password" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="md-logo--title">Quên Mật Khẩu</div>
                <p class="p-text">Nhập email để nhận lại mật khẩu mới</p>
                <div class="md-input form-horizontal">
                    <div class="row">
                            <form class="bv-form" novalidate="novalidate" action="{{route('web.forgot.index') }}" method="POST">
                                @if (session('status_forgot_error'))
                                <div class="alert alert-info text-small alert-dismissible" role="alert">{{session('status_forgot_error')}} <button type="button" class="close" data-dismiss="alert"></button></div>
                                @endif
                                @if (session('status_forgot_success'))
                                <div class="alert alert-info text-small alert-dismissible" role="alert">{{session('status_forgot_success')}} <button type="button" class="close" data-dismiss="alert"></button></div>
                                @endif
                             @csrf
                            <div class="col-sm-12">
                                <div id="form-input" class="form-group has-feedback has-success">
                                    <div class="md-div md-icon--email">
                                        <input id="email" name="email" required title="Vui lòng nhập giá trị"
                                            type="text" class="form-control" placeholder="email@example.com"
                                            data-bv-field="email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 md-button text-center">
                                <div class="form-group">
                                    <button id="continue-forgot-password"  type="submit" class="btn btn-login">Tiếp tục</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('runJS')
@parent
    @if (session('status_forgot_error')||session('status_forgot_success'))
    <script>
        $("#popup-forgot-password").modal('show');
    </script>
    @endif
@endsection

