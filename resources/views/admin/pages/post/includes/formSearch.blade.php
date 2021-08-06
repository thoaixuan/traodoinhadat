<form action="">
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
            <select class="form-control select2" name="type">
                <option {{$post_status=='published'?'selected':''}} value="published"> -- Công khai -- </option>
                <option {{$post_status=='hot'?'selected':''}} value="hot"> -- Tin HOT -- </option>
                <option {{$post_status=='draft'?'selected':''}} value="draft"> -- Bảng nháp -- </option>
            </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" name="q" value="{{$search}}" placeholder="Tìm kiếm ... " />
                    <div class="input-group-append">
                    <button onclick="$('input[name=q]').val('')" class="btn btn-sm btn-outline-danger" type="button">Hủy</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
            <select class="form-control select2" name="c">
                <option value=""> -- TẤT CẢ DANH MỤC -- </option>
                @foreach (getCategoryPost() as $item)
                        <option  {{$category==$item->id?'selected':''}} value="{{$item->id}}">{{$item->cate_name}}</option>
                        @if (count($item->sub_menu)>0)
                            @foreach ($item->sub_menu as $sub)
                            <option {{$category==$sub->id?'selected':''}} value="{{$sub->id}}"> -- {{$sub->cate_name}}</option>
                            @endforeach
                        @endif
                @endforeach
            </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-outline-info btn-block">Tìm kiếm</button>
            </div>
        </div>
    </div>
</form>
