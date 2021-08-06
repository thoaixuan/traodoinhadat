<div class="col-lg-6 col-md-8 col-rented-ccch">
    <div class="title-1 cl6">Tình trạng</div>
    <label class="checkbox"><input type="checkbox" {{ request()->get('dacbiet')=='on'?'checked':'' }} id="dac-biet" name="dac-biet" value="on"> <span></span> Đặc biệt</label>
    <label class="checkbox"><input type="checkbox" {{ request()->get('dathamdinh')=='on'?'checked':'' }} id="da-tham-dinh" name="da-tham-dinh" value="on"> <span></span> Đã thẩm định</label>
    <label class="checkbox"><input type="checkbox" {{ request()->get('daban')=='on'?'checked':'' }} id="da-ban" name="da-ban" value="on"> <span></span> Đã bán</label>
</div>
