<form action="">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
            <select class="form-control select2" name="type">
                <option {{$realestate_status=='published'?'selected':''}} value="published"> -- Công khai -- </option>
                <option {{$realestate_status=='draft'?'selected':''}} value="draft"> -- Bảng nháp -- </option>
                <option {{$realestate_status=='lock'?'selected':''}} value="lock"> -- Khóa -- </option>


            </select>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" name="q" value="{{$search}}" placeholder="Tìm kiếm ... " />
                    <div class="input-group-append">
                    <button onclick="$('input[name=q]').val('')" class="btn btn-sm btn-outline-danger" type="submit">Hủy</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group" >
                <select class="form-control form-control-sm select2" id="cate_type" name="cate_type">
                    <option value=""> -- Tất cả loại tin  --</option>
                    <option value="cate_buy"> -- Mua bán -- </option>
                    <option value="cate_lease"> -- Cho thuê --</option>
                    <option value="cate_project"> -- Dự án --</option>

                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <select class="form-control select2" id="category_id" name="category">
                <option value=""> -- Tất cả loại tin -- </option>

            </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-outline-info btn-block">Tìm kiếm</button>
            </div>
        </div>
    </div>
</form>
