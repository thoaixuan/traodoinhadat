<select id="realestate_dat_dientich" class="select style-0" name="realestate_dat_dientich">
    <option {{ request()->get('min')==''?'selected':'' }} value="" data-min-size="" data-max-size="">Diện tích</option>
    <option {{ request()->get('min')=='0'?'selected':'' }} value="0" data-min-size="0" data-max-size="30">Dưới 30 m2</option>
    <option {{ request()->get('min')=='31'?'selected':'' }} value="31" data-min-size="31" data-max-size="40">31 m2 - 40 m2</option>
    <option {{ request()->get('min')=='41'?'selected':'' }} value="41" data-min-size="41" data-max-size="50">41 m2 - 50 m2</option>
    <option {{ request()->get('min')=='51'?'selected':'' }} value="51" data-min-size="51" data-max-size="60">51 m2 - 60 m2</option>
    <option {{ request()->get('min')=='61'?'selected':'' }} value="61" data-min-size="61" data-max-size="70">61 m2 - 70 m2</option>
    <option {{ request()->get('min')=='71'?'selected':'' }} value="71" data-min-size="71" data-max-size="80">71 m2 - 80 m2</option>
    <option {{ request()->get('min')=='81'?'selected':'' }} value="81" data-min-size="81" data-max-size="90">81 m2 - 90 m2</option>
    <option {{ request()->get('min')=='91'?'selected':'' }} value="91" data-min-size="91" data-max-size="100">91 m2 - 100 m2</option>
    <option {{ request()->get('min')=='100'?'selected':'' }} value="100" data-min-size="100" data-max-size="100000">Trên 100 m2</option>
</select>
