<div class="card">
    <div class="card-header" id="heading5">
      <h4 class="card-title">
        <a data-toggle="collapse" role="button" data-target="#ngannhang" aria-expanded="false"
          aria-controls="ngannhang">
          <h3>Đảm bảo thanh toán qua ngân hàng</h3>
        </a>
      </h4>
    </div>

    <div id="ngannhang" class="collapse" aria-labelledby="heading5" data-parent="#accordionExample">
      <div class="card-body">
        <form id="form-dambaoTTNN">
          <p>Để đảm bảo khoản tiền đặt cọc và khoản thanh toán mua bán nhà được an toàn và minh bạch,
            ING
            hỗ trợ khách hàng dịch vụ thanh toán đảm bảo qua ngân hàng Vietcombank hoàn toàn miễn phí.</p>
          <p>Hiện nay các ngân hàng đang thu phí khoản bảo vệ giao dịch này là 0.2%, ví dụ căn nhà giá 3
            tỷ
            đồng thì phí sẽ là 6.000.000&nbsp;VNĐ, nhưng hiện nay ING đang hỗ trợ miễn phí cho khách
            hàng.</p>
          <p class="card-body__slogan">Sử dụng Dịch vụ đảm bảo thanh toán của ING bạn được:</p>
          <ul class="card-body__list">
            <li>Đảm bảo quyền lợi mua bán, giao dịch an toàn: không ai lo sợ mất tiền, hay chậm trễ thanh
              toán,....</li>
            <li>Tài khoản đảm bảo thanh toán của người mua được quản lý bởi ING và ngân hàng</li>
            <li>Hồ sơ nhà đất liên quan đến điều kiện thanh toán giữa bên bán – bên mua được kiểm soát
              chặt
              chẽ trong quá trình thanh toán. Vì vậy, nếu bất động sản bị vướng pháp lý chắc chắn sẽ được
              thông báo cho bên mua.</li>
          </ul>
          <div class="row">
            <div class="col-sm-12">
                @include('web.pages.service.includes.form-main')
            </div>
            <div class="col-sm-12">
                <div class="form-group form-lr">
                  <div class="col-sm-4">
                    <input type="hidden" name="type_contact" value="service_dambaoTTNN"/>
                    <input type="hidden" name="title" value="Đảm bảo thanh toán ngân hàng"/>
                    <button class="btn__register" data-url="{{ route('web.page.service.dambaoTTNN') }}" id="button-dambaoTTNN" type="button"> Đăng Ký Dịch Vụ</button>
                  </div>
                </div>
              </div>
        </div>
        </form>
      </div>
    </div>
  </div>
