<form id="formAction">
<div class="modal fade" id="parentAction" tabindex="-1" role="dialog" aria-labelledby="parentActionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="parentActionLabel">Thêm danh mục</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">



                <div class="form-group">
                    <div id="AlertJS"></div>
                </div>

                    <div class="form-group">
                        <label>Danh mục </label>
                        <select class="form-control" id="cate_parentID" name="cate_parentID">
                            <option value="">-- TẤT CẢ DANH MỤC --</option>
                            @foreach (getListParent() as $item)
                                <option  value="{{$item->id}}">{{$item->cate_name}}</option>

                            @endforeach
                        </select>
                    </div>

                <div class="form-group">
                    <label for="cate_name" class="col-form-label">Tiêu đề</label>
                    <input type="text" class="form-control" name="cate_name" id="cate_name">
                </div>
                <div class="form-group">
                    <label for="cate_order" class="col-form-label">Sắp xếp</label>
                    <input type="number" min="1" max="100" class="form-control" name="cate_order" id="cate_order">
                </div>
                <div class="form-group">
                    <label for="cate-des" class="col-form-label">Mô tả</label>
                    <textarea class="form-control" name="cate-des" id="cate-des"></textarea>
                </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">HỦy</button>
          <button type="submit" id="buttonSaveData" class="btn btn-primary">Lưu</button>
        </div>
      </div>
    </div>
  </div>
</form>
