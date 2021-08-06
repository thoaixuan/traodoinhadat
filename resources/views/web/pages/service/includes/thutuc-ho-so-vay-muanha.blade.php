
<div class="card">
    <div class="card-header" id="heading4">
      <h4 class="card-title">
        <a data-toggle="collapse" role="button" data-target="#thutuchoso" aria-expanded="false"
          aria-controls="thutuchoso">
          <h3>Thủ tục và hồ sơ vay mua nhà</h3>
        </a>
      </h4>
    </div>

    <div id="thutuchoso" class="collapse" aria-labelledby="heading4" data-parent="#accordionExample">
      <div class="card-body">
        <div class="card-body">
            <form id="form-thutucvahosoBDS">
            <p>Bạn đã tìm được căn nhà ưng ý nhưng chưa đủ tài chính để thực hiện giao dịch ? <br> Liên hệ
              ngay với ING để được hỗ trợ thủ tục vay mua nhà. Chuyên gia Pháp lý, tài chính ING sẽ
              giúp bạn có những phân tích đánh giá các gói vay mua nhà từ nhiều ngân hàng để cho bạn những
              lựa chọn phù hợp nhất với nhu cầu.</p>
            <p class="card-body__slogan">Vui lòng cung cấp thông tin chính xác để sử dụng dịch vụ</p>
            <div class="row">
                <div class="col-sm-12">
                    @include('web.pages.service.includes.form-main')
                </div>
                <div class="col-sm-12">
                    <div class="form-group form-lr">
                      <div class="col-sm-4">
                        <input type="hidden" name="title" value="Thủ tục và hồ sơ vay mua nhà"/>
                        <input type="hidden" name="type_contact" value="service_thutucvahosoBDS"/>
                        <button class="btn__register" data-url="{{ route('web.page.service.thutucvahosoBDS') }}" id="button-thutucvahosoBDS" type="button"> Đăng Ký Dịch Vụ</button>
                      </div>
                    </div>
                  </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
