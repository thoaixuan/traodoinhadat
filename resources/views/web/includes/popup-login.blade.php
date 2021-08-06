<div class="modal md-popup md-login" id="popup-login" tabindex="-1" aria-labelledby="popup-login" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <div class="modal-body">
            <div class="md-logo--title">Đăng nhập tài khoản với ING</div>
            @if (setting()->google_status=='on'||setting()->facebook_status=='on')
                @if (setting()->facebook_status=='on')
                    <a href="{{route('web.social.oauth','facebook')}}" class="btn btn-primary btn-block">Đăng nhập qua Facebook</a>
                @endif
                @if (setting()->google_status=='on')
                <a href="{{route('web.social.oauth','google')}}" class="btn btn-danger btn-block">Đăng nhập qua Google</a>
                @endif
            @endif
            <p class="p-text">-Hoặc đăng nhập bằng email/ số điện thoại-</p>
            <div class="bl-input form-horizontal">
                <div class="row">
                    <form id="form-login" class="form-login">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div id="alertJSLogin">
                                    @if (session('status_login'))
                                    <div class="alert alert-info text-small alert-dismissible" role="alert">{{session('status_login')}} <button type="button" class="close" data-dismiss="alert"></button></div>

                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="md-div md-icon--phone">
                                    <input type="text" name="phone" id="phone" class="form-control" value=""
                                        placeholder="email@example.com / 073023000">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="md-div md-icon--password">
                                    <input data-type="password" type="password" name="password" value=""
                                        class="form-control" placeholder="Mật khẩu" id="password">
                                    <span class="far fa-eye span-eyes"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 md-remember">
                            <div class="d-inline-block md-brand">
                                <div class="checkbox md-checkbox">
                                    <input id="remenber_pass_1" class="requestType" type="checkbox"
                                        name="remenber_pass" value="1">
                                    <label for="remenber_pass_1">Ghi nhớ tài khoản</label>
                                </div>
                            </div>
                            <div class="d-inline-block pull-right">
                                <p class="forgot-password">Quên mật khẩu?</p>
                            </div>
                        </div>
                        <div class="col-sm-12 md-button text-center">
                            <div class="form-group">
                                <button  type="submit"  data-url="{{ route('web.auth.ajaxLogin') }}" class="btn btn-login" id="login-normal">Đăng
                                    Nhập</button>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <div class="md-creat-account">
                                <a class="signup-account">Tạo tài khoản mới</a>
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
    @if (session('status_login'))
    <script>
        $("#popup-login").modal('show');
    </script>
    @endif
@endsection

