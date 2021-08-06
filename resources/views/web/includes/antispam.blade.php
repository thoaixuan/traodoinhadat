

<div class="modal " id="antispam" tabindex="-1" aria-labelledby="antispam" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="Antispam-form-confirm">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="alert alert-warning alert-dismissible">
                            Để giúp bảo vệ bạn khỏi hành vi lạm dụng, chúng tôi yêu cầu xác minh bạn không phải là Robot ? 
                            Kết quả của phép toán:  </br><span> {{$antispam->textMath}}</span> 
                        </div>
                        <div id="alertJSAntispam"></div>
                    </div>
                    <div class="form-group">
                        <input required class="form-control" placeholder="Nhập kết quả" id="resultMath" type="number" name="resultMath"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" aria-label="Close" class="btn btn-danger" id="contact-button-cancel">Hủy bỏ</button>
                    <button class="btn btn-dark" id="Antispam-button-confirm" type="submit"> Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
 </div>
