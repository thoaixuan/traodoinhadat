
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Hướng </label>
                <select name="realestate_nha_huong" id="realestate_nha_huong" class="form-control form-control-sm select2">
                    @foreach (listHuong() as $item)
                    <option {{$realestate->realestate_nha_huong==$item['value']?'selected':''}} value="{{ $item['value'] }}">{{ $item['text'] }}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <label>Phòng ngủ </label>
                <input type="number" value="{{$realestate->realestate_nha_phongngu}}" name="realestate_nha_phongngu" placeholder="Phòng ngủ ... " class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <label>Phòng Tắm </label>
                <input type="number" value="{{$realestate->realestate_nha_phongtam}}" name="realestate_nha_phongtam" placeholder="Phòng tắm ... " class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <label>Tầng </label>
                <input type="number" value="{{$realestate->realestate_nha_tan}}" name="realestate_nha_tan" placeholder="Tần ... " class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Giấy tờ </label>
                <select name="realestate_nha_giayto" id="realestate_nha_giayto" class="form-control form-control-sm select2">
                    @foreach (listGiayTo() as $item)
                    <option {{$realestate->realestate_nha_giayto==$item['value']?'selected':''}} value="{{ $item['value'] }}">{{ $item['text'] }}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <label>Chiều dài </label>
                <input type="text" value="{{$realestate->realestate_nha_chieudai}}" id="realestate_nha_chieudai" name="realestate_nha_chieudai" placeholder="Chiều dài ... " class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <label>Chiều rộng </label>
                <input type="text" value="{{$realestate->realestate_nha_chieurong}}" id="realestate_nha_chieurong" name="realestate_nha_chieurong" placeholder="Chiều rộng ... " class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <label>Hẻm</label>
                <select name="realestate_nha_giayto" id="realestate_nha_hem" class="form-control form-control-sm select2">
                    @foreach (listViTri() as $item)
                    <option {{$realestate->realestate_nha_hem==$item['value']?'selected':''}} value="{{ $item['value'] }}">{{ $item['text'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

