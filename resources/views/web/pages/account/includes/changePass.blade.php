<form id="formChangePass" action="{{route('web.account.changePass')}}">
    <div class="card card-body">
        <div class="form-group">
            <div class="alertJSChangePass">
            </div>
        </div>
        <div class="form-group ">
            <label for="old_password">Nhập lại mật khẩu cũ <span class="text-danger old_password"></span>
            </label>
            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="...">
        </div>
        <div class="form-group ">
            <label for="new_password">Nhập mật khẩu mới <span class="text-danger old_password"></span>
            </label>
            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="...">
        </div>
        <div class="form-group ">
            <label for="re_password" class="">Xác nhận lại mật khẩu mới <span class="text-danger old_password"></span>
            </label>
            <input type="password" class="form-control" id="re_password" name="re_password" placeholder="...">
        </div>

    </div>
    <div class="card card-footer">
            <button type="submit" id="onSaveChangePass" class="btn btn-success">Lưu</button>
    </div>
</form>
