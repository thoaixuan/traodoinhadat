@extends('web.layouts.page')
@section('page')
<section class="content">
    <div class="service">
      <div class="sv-banner">
        <h1>Giao dịch Bất Động Sản an toàn với ING</h1>
      </div>
      <div class="sv-content">
        <div class="container-fluid">
          <div class="sv-info">
            <h2 class="sv-info__title">Dịch vụ của ING</h2>
            <div class="sv-info__content">
              <p>ING ứng dụng công nghệ hiện đại vào việc xây dựng tính năng "Gửi BĐS MIỄN PHÍ" và là công ty đầu
                tiên tại Việt Nam xây dựng nên "QUY TRÌNH GIAO DỊCH BẤT ĐỘNG SẢN KHÉP KÍN", giúp thương vụ mua bán
                diễn
                ra an toàn, đạt hiệu quả cao và giảm thiểu thời gian, chi phí trong giao dịch.</p>
              <p>Với đội ngũ nhân viên &amp; chuyên gia được đào tạo bài bản kết hợ̣p với sự am hiểu sâu sắc về thị
                trường bất động sản, ING cung cấp các dịch vụ trọn gói trong giao dịch bất động sản (BĐS) để hỗ
                trợ khách hàng.</p>
            </div>
            <div class="accordion sv-info__panel" id="accordionExample">
                @include('web.pages.service.includes.phap-ly')
                @include('web.pages.service.includes.thamdinh-gia-bds')
                <div class="card">
                    <div class="card-header" id="heading3">
                    <h4 class="card-title">
                        <a data-toggle="collapse" role="button" data-target="#thongtinquyhoach" aria-expanded="false"
                        aria-controls="thongtinquyhoach">
                        <h3>Thông tin quy hoạch</h3>
                        </a>
                    </h4>
                    </div>

                    <div id="thongtinquyhoach" class="collapse" aria-labelledby="heading3"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>
                        Thông tin quy hoạch và chứng chỉ quy hoạch là một trong những dữ liệu cần thiết để thực hiện các
                        giao dịch mua bán bất động sản và hoạt động sửa chữa, xây mới nhà cửa. Chứng chỉ quy hoạch giúp
                        khách mua biết được chính xác phần đất được công nhận trong giao dịch mua bán nhà. Chủ nhà phải
                        liên hệ Phòng quản lý đô thị trực thuộc UBND các quận huyện để có được những thông tin này.
                        <br><br>
                        ING cung cấp dịch vụ thông tin quy hoạch và chứng chỉ quy hoạch nhằm giảm thiểu thời gian đi
                        lại của khách hàng. Để tìm hiểu kỹ về dịch vụ này, vui lòng liên hệ ING qua Hotline <a title="Call" class="text-primary" href="tel:+{{ setting()->contact_phone }}">*8080.</a>
                        </p>
                    </div>
                    </div>
                </div>
                @include('web.pages.service.includes.dam-bao-thanhtoan-nganhang')
                @include('web.pages.service.includes.thutuc-ho-so-vay-muanha')
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="sv-know">
          <h2 class="sv-know__title">Bạn cần biết</h2>
          <div class="row">
            <div class="col-sm-3">
              <a href="#">
                <img src="{{asset('themes/web/img/img-service-1.jpg')}}" class="img-fluid">
                <p>Năm <?php echo date("Y"); ?> khách hàng mua nhà đất như thế nào?</p>
              </a>
            </div>
            <div class="col-sm-3">
              <a href="#">
                <img src="{{asset('themes/web/img/img-service-2.jpg')}}" class="img-fluid">
                <p>12 loại giấy tờ cần xác thực pháp lý trước khi quyết định mua nhà đất</p>
              </a>
            </div>
            <div class="col-sm-3">
              <a href="#">
                <img src="{{asset('themes/web/img/img-service-3.jpg')}}" class="img-fluid">
                <p>4 bước mua nhà cùng ING</p>
              </a>
            </div>
            <div class="col-sm-3">
              <a href="#">
                <img src="{{asset('themes/web/img/img-service-4.png')}}" class="img-fluid">
                <p>Lợi ích dịch vụ Bán nhà độc quyền với ING</p>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@include('web.includes.service_subfooter')
@endsection
@section('runJS')
<script src="{{asset('web/service/service.js')}}?v={{time()}}"></script>
<script>
   var service = new service();
   service.datas={

   }
   service.init();
</script>
@endsection
