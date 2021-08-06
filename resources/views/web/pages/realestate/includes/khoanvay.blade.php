<div id="bankLoanBody" class="bankLoanBody boxwidget ">
    <div class="acordion-detail box-collapse">
        <div class="tab">
            <h2 class="tab-title">
                Khoản vay <span class="triangle"> <i class="icon-arrow-2 ib"></i> </span>
            </h2>
            <div class="tab-content entry-content" style="display: block;">
                <div class="titlet">
                    <i class="icon-calculator"></i>
                    Tính toán Trả góp
                    <span class="pull-right price">
                        <span id="pay-loan-ajax" class="price-3 payPerMonth">~38,2 triệu/tháng
                        </span>
                    </span>
                </div>
                <div class="row wrangeprice list-item">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-6 text">Ngân hàng</div>
                            <div class="col-6 ">
                                <select id="select-bank" class="select">
                                    <option rate="7.7" value="5">Vietcombank</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-6 text">Lãi suất <span class="small">(Năm)</span>
                            </div>
                            <div class="col-6 ">
                                <div class="input-group">
                                    <input id="loanRate" type="text" class="input laisuat"
                                        value="7.7" disabled="">
                                    <div class="input-group-addon">%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-6 text">Giá</div>
                            <div class="col-6 ">
                                <div class="input-group">
                                    <input type="text" class="input price-1" value="3,7 tỷ"
                                        disabled="">
                                    <div class="input-group-addon">đ</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-6 text">
                                Khoản vay <span class="small">(Tương ứng)</span>
                            </div>
                            <div class="col-6 ">
                                <div class="input-group">
                                    <input id="money" type="text" name="money"
                                        class="input price-1" value="2590000000"
                                        max="2590000000">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-6 text">
                                Kì hạn <span class="small">(Năm)</span>
                            </div>
                            <div class="col-6 ">
                                <div class="input-group">
                                    <select id="loan-year" class="select">
                                        <option selected="" value="10"> 10 năm </option>
                                        <option value="15"> 15 năm </option>
                                    </select>
                                    <div class="input-group-addon">Năm</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wbtn text-center">
                    <a class="btn btnModal" data-modal="vayvonModal">Đăng kí vay</a>
                </div>
            </div>
        </div>
    </div>
</div>
