
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Diện tích (m2)</label>
                <input type="text" value="{{$realestate->realestate_dat_dien_tich}}" id="realestate_dat_dien_tich" name="realestate_dat_dien_tich" placeholder="Diện tích ... " class="form-control form-control-sm">
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Giấy tờ </label>
                <select name="realestate_dat_giayto" id="realestate_dat_giayto" class="form-control form-control-sm select2">
                    <option {{$realestate->realestate_dat_giayto=='1'?'selected':''}} value="1">Đã cố sổ</option>
                    <option {{$realestate->realestate_dat_giayto=='2'?'selected':''}} value="2">Chưa có sổ</option>
                </select>
            </div>
        </div>
    </div>
