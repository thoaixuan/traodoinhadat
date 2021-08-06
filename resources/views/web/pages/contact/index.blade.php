@extends('web.layouts.page')
@section('page')
       <!-- Liên Hệ -->
       <section class="content">
        <section class="contact">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Liên hệ với ING</h1>
                        <div class="contact--description">
                            <p class="contact--description__bold">Bạn có câu hỏi cần trợ giúp?</p>
                            <p>
                                Tham khảo <a href="#">Những Câu Hỏi Thường Gặp</a>. Nếu không tìm thấy giải đáp cho
                                vấn đề của bạn, liên hệ ING theo thông tin dưới đây:
                            </p>
                        </div>
                        <p class="icon icon-telephone">{{ setting()->contact_phone }}</p>
                        <p class="icon icon-email">
                            <a class="mailto" href="mailto:{{ setting()->contact_mail }}?Subject=Liên hệ"
                                itemprop="email">{{ setting()->contact_mail }}</a>
                        </p>
                        <p>Hoặc gửi tin nhắn trực tiếp cho chúng tôi</p>
                        <div class="form-block">
                            <form id="formAction" action="{{ route('web.contact.sendContact') }}">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                        <input name="full_name" type="text" class="form-control" id="full_name"
                                            placeholder="Họ và tên">
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                        <input name="email" type="text" class="form-control" id="email"
                                            placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                        <input name="phone" type="text" class="form-control phone-validate" id="phone"
                                            placeholder="Số điện thoại">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                        <input name="title" type="text" class="form-control" id="title"
                                            placeholder="Tiêu đề">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                        <textarea name="body" id="body" class="form-control" rows="3"
                                            placeholder="Câu hỏi hoặc ý kiến"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div id="alertPageContact"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button id="sendContact" type="button"  class="btn btn-send">Gửi</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="contact--jobs">
                            <h2>Truyền Thông - Hợp Tác</h2>
                            <div class="jobs--info">
                                <p>
                                    ING chào đón mọi email đến từ quý anh chị phóng viên, biên tập viên, blogger
                                    hoặc bất kỳ ai quan tâm đến việc kể lại câu chuyên của ING: giao dịch BĐS nay
                                    thật dễ dàng, nhanh chóng và tiện lợi nhờ sự kết hợp với công nghệ tiên tiến.
                                    <br><br>
                                    ING hướng đến mục đích đem lại trải nghiệm tốt nhất cho khách hàng sử dụng
                                    dịch vụ trên ING. Và mọi việc sẽ dễ dàng hơn nếu ING có được sự hợp tác từ
                                    quý doanh nghiệp và đối tác kinh doanh tiềm năng. ING đón chờ quý doanh
                                    nghiệp có ý tưởng hợp tác về ứng dụng công nghệ, mở rộng phân khúc khách hàng
                                    hoặc bất kỳ đề xuất sáng tạo nào khác.
                                    <br><br>
                                    Quý anh chị có nhu cầu đặt lịch phỏng vấn, viết bài hoặc đề xuất hợp tác, vui
                                    lòng liên hệ phòng Marketing, email <a class="mailto"
                                        href="mailto:{{ setting()->contact_mail }}?Subject=Liên hệ">{{ setting()->contact_mail }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!-- Liên Hệ -->

    @include('web.includes.service_subfooter')
    @endsection
    @section('runJS')
    <script src="{{asset('web/contact/contact.js')}}?v={{time()}}"></script>
    <script>
       var contact = new contact();
       contact.datas={

       }
       contact.init();
    </script>
    @endsection

