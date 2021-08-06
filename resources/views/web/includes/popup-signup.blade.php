<div class="modal md-popup md-login" id="popup-signup" tabindex="-1" aria-labelledby="popup-signup" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="md-logo--title">Đăng ký tài khoản với ING</div>
                <div class="md-user">
                <form id="formRegister" class="form-login">
                    <div class="md-radio">
                        <div class="row">
                            <div class="col-md-3">
                                <p>Bạn là?</p>
                            </div>
                            <div class="col-md-9">
                            {{--<div class="i-radio">
                                    <input type="radio" checked="" id="procedureTypeId1" name="procedureTypeId"
                                        class="procedureTypeId" value="0">
                                    <label for="procedureTypeId1">Chủ nhà</label>
                                </div>Đù !!! sao cái nào nó cũng k chạy--}}

                                <div class="col-md-6">
                                    <div class="i-radio">
                                        <input type="radio" checked="" id="procedureTypeId1" name="loai_hinh_thuc_bds"
                                            class="procedureTypeId" value="chu_nha">
                                        <label for="procedureTypeId1">Chủ nhà</label>
                                    </div>
                                </div>

                                    <div class="i-radio">
                                        <input type="radio" id="procedureTypeId2" name="loai_hinh_thuc_bds"
                                            class="procedureTypeId" value="moi_gioi">
                                        <label for="procedureTypeId2">Môi giới</label>
                                    </div>

                            </div>
                        </div>
                    </div>
                    @if (setting()->google_status=='on'||setting()->facebook_status=='on')
                        @if (setting()->facebook_status=='on')
                            <a href="{{route('web.social.oauth','facebook')}}" class="btn btn-primary btn-block">Đăng nhập qua Facebook</a>
                        @endif
                        @if (setting()->google_status=='on')
                        <a href="{{route('web.social.oauth','google')}}" class="btn btn-danger btn-block">Đăng nhập qua Google</a>
                        @endif
                    @endif
                    <p class="p-text">-Hoặc đăng ký mới-</p>
                    <div class="md-input form-horizontal">
                        <div class="alertJSRegister"></div>
                        <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="md-div md-icon--fullname">
                                            <input type="text" value="" name="full_name" id="fullname_register"
                                                class="form-control" placeholder="" required="required" >
                                            <label for="fullname_register">Họ và tên</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="md-div md-icon--phone">
                                            <input type="text" value="" name="phone" id="phone_register" class="form-control number-validate" placeholder="" required="required">
                                            <label for="phone_register">Số điện thoại</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="md-div md-icon--email">
                                            <input type="email" value="" id="email_register" name="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="md-div md-icon--password">
                                            <input type="password" value="" name="password" id="password_register"
                                                class="form-control" placeholder="" required="required">
                                            <label for="password_register">Mật khẩu</label>
                                            <span class="far fa-eye span-eyes"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 md-button text-center">
                                    <div class="form-group">
                                        <button type="button" data-url="{{ route('web.auth.ajaxRegister') }}" id="buttonRegister" class="btn btn-login">Đăng Ký</button>
                                    </div>
                                </div>
                                <div class="md-remember text-center">
                                    <div class="d-inline-block md-creat-account ">
                                        <a class="login-account">Đã có tài khoản</a>
                                    </div>
                                </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
