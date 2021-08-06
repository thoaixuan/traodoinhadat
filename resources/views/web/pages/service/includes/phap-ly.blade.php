<div class="card">
    <div class="card-header" id="headingOne">
      <h4 class="card-title">
        <a data-toggle="collapse" role="button" data-target="#phaplybatdongsan" aria-expanded="false"
          aria-controls="phaplybatdongsan">
          <h3>Pháp lý bất động sản</h3>
        </a>
      </h4>
    </div>

    <div id="phaplybatdongsan" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <form id="form-phaplyBDS">
          <p>Trong các giao dịch bất động sản, cả người mua và người bán, người chuyển nhượng và người
            nhận
            chuyển nhượng nhà đất đều phải trải qua nhiều thủ tục pháp lý, cần đến nhiều loại giấy tờ quan
            trọng. Bao gồm các bước: chuẩn bị hồ sơ giấy tờ, soạn hợp đồng mua bán, ký kết và công chứng
            hợp
            đồng mua bán/ chuyển nhượng, kê khai thuế và nộp thuế nhà đất, và làm thủ tục sang tên mua
            bán/
            chuyển nhượng bất động sản...v.v.. tại cơ quan chức năng có thẩm quyền.</p>
          <p class="card-body__slogan card-body__want">Bạn cần ING hỗ trợ thực hiện các thủ tục giấy tờ
            pháp lý bất động sản? Vui lòng chọn dịch vụ cần hỗ trợ:</p>
          <div class="card-body__radio">
            <div class="i-radio">
              <input type="radio"  id="update1" name="procedureTypeId" class="procedureTypeId" value="Cập nhật đăng bộ, sang tên">
              <label for="update1"> Cập nhật đăng bộ, sang tên </label>
            </div>
            <div class="i-radio">
              <input type="radio"  id="update2" name="procedureTypeId" class="procedureTypeId" value=" Cấp đổi giấy chứng nhận quyền sở hữu nhà và đất ở ">
              <label for="update2"> Cấp đổi giấy chứng nhận quyền sở hữu nhà và đất ở  </label>
            </div>
            <div class="i-radio">
              <input type="radio"  id="update3" name="procedureTypeId" class="procedureTypeId" value="Tách thửa, nhập thửa">
              <label for="update3"> Tách thửa, nhập thửa </label>
            </div>
            <div class="i-radio">
              <input type="radio"  id="update4" name="procedureTypeId" class="procedureTypeId" value=" Thừa kế - Kê khai di sản bất động sản ">
              <label for="update4">  Thừa kế - Kê khai di sản bất động sản  </label>
            </div>
            <div class="i-radio">
              <input type="radio"  id="update5" name="procedureTypeId" class="procedureTypeId" value=" Hỗ trợ xin phép Xây dựng, hoàn công xây dựng ">
              <label for="update5">  Hỗ trợ xin phép Xây dựng, hoàn công xây dựng  </label>
            </div>
            <div class="i-radio">
              <input type="radio"  id="update6" name="procedureTypeId" class="procedureTypeId" value="  Đăng ký cập nhật diện tích xây dựng mới vào chủ quyền ">
              <label for="update6">  Đăng ký cập nhật diện tích xây dựng mới vào chủ quyền  </label>
            </div>
          </div>
          <p class="card-body__slogan">Vui lòng cung cấp thông tin chính xác để sử dụng dịch vụ</p>
          <div class="row">
            <div class="col-sm-12">
                @include('web.pages.service.includes.form-main')
            </div>
            <div class="col-sm-12">
                <div class="form-group form-lr">
                  <div class="col-sm-4">
                    <input type="hidden" name="type_contact" value="service_phaplyBDS"/>
                    <input type="hidden" name="title" value="Pháp Lý Bất Động Sản"/>
                    <button class="btn__register" data-url="{{ route('web.page.service.phaplyBDS') }}" id="button-phaplyBDS" type="button"> Đăng Ký Dịch Vụ</button>
                  </div>
                </div>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
