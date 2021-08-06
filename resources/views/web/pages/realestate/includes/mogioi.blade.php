
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <label class="col-lg-4  control-label">
                <span class="text">Thông tin môi giới</span>
            </label>
            <div class="col-lg-8  control-label">
                <div class="bl-checkbox"><input type="checkbox" id="chinh_chu" class="isOwner" name="chinh_chu" value="1"><label class="label_active" for="chinh_chu">Chính chủ</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">

                        <input name="name_agent" id="name_agent"
                            class="form-control" type="text"
                            placeholder="Họ tên" value="{{ user()->full_name }}"
                            readonly="readonly">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">

                        <input name="phone_agent" id="phone_agent"
                            class="form-control" type="text"
                            placeholder="Số điện thoại" value="{{ user()->phone }}"
                            readonly="readonly">


                </div>
            </div>
            
            <div class="col-sm-12">
                <div class="form-group">
                        <input name="email_agent" id="email_agent"
                            class="form-control" type="text" placeholder="Email"
                            value="{{ user()->email }}" readonly="readonly">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
            <div class="row" id="show_chu_nha">
                <label class="col-lg-12 col-md-12 control-label">
                    <span class="text">Thông tin chủ nhà</span>
                </label>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input name="chu_nha_full_name" id="chu_nha_full_name" class="form-control"
                        type="text" placeholder="Họ tên">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input name="chu_nha_phone" id="chu_nha_phone" class="form-control"
                        type="text" placeholder="Số điện thoại">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <input name="chu_nha_email" id="chu_nha_email" class="form-control"
                        type="text" placeholder="Email">
                    </div>
                </div>
            </div>
    </div>
</div>


