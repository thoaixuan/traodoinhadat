<div class="card">
    <div class="card-header" id="heading2">
      <h4 class="card-title">
        <a data-toggle="collapse" role="button" data-target="#thamdinhbatdongsan" aria-expanded="true"
          aria-controls="thamdinhbatdongsan">
          <h3>Thẩm định giá bất động sản</h3>
        </a>
      </h4>
    </div>

    <div id="thamdinhbatdongsan" class="collapse show" aria-labelledby="heading2"
      data-parent="#accordionExample">
      <div class="card-body">
        <p>Thẩm định giá bất động sản là sự đánh giá hoặc đánh giá lại về giá trị của bất động sản phù hợp
          với thị trường tại một địa điểm, thời điểm nhất định theo tiêu chuẩn Việt Nam hoặc thông lệ quốc
          tế. Như vậy, thẩm định giá bất động sản là sự ước tính giá trị của quyền sử dụng đất, quyền sở
          hữu
          nhà và công trình vật kiến trúc gắn liền với đất bằng hình thức tiền tệ. Người ta thường thẩm
          định
          giá bất động sản khi có nhu cầu bảo toàn, mua bán, chuyển nhượng, bồi thường, thế chấp, tính
          thuế,
          thanh lý bất động sản...</p>
        <p class="card-body__slogan">Bạn muốn biết thông tin về giá trị bất động sản bạn đang sở hữu ?</p>
        <p>Hãy cho biết các thông tin chi tiết về bất động sản để ING hỗ trợ bạn tốt hơn:</p>
        <div class="card-body__form">
            <form id="form-thamdinhBDS">
                <p class="form__slogan">
                1. Thông tin liên hệ của bạn
                </p>
                <div class="row">
                    <div class="col-sm-12">
                        @include('web.pages.service.includes.form-main')
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group form-lr">
                        <div class="col-sm-4">
                            <input type="hidden" name="type_contact" value="service_thamdinhBDS"/>
                            <input type="hidden" name="title" value="Thủ tục và hồ sơ vay mua nhà"/>
                            <button class="btn__register" data-url="{{ route('web.page.service.thamdinhBDS') }}" id="button-thamdinhBDS" type="button"> Đăng Ký Dịch Vụ</button>
                        </div>
                        </div>
                    </div>
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>
