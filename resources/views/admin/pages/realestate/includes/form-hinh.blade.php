<div class="form-group">
    <label>Hình ảnh (jpg,png,gif,jpeg)</label>
    <div id="alertJSUploadImg"></div>
    <div class="row" id="show-item">
        <div class="col-md-4 item-image" id="item-image-default">
            <input  type="file" class="d-none file_realestate_image">
            <input  type="text" value="{{asset('uploads/defaults/photos-icon.png')}}" name="file_realestate_image[]" class="d-none file_realestate_image">
            <div class="realestate-select-image-container change_realestate_image">
                <label class="btn-select-image">
                    <img height="150"  width="150" src="{{asset('uploads/defaults/photos-icon.png')}}"/>
                </label>
            </div>
        </div>
        @isset($realestate->arrayImages)
            @foreach ($realestate->arrayImages as $url)
            <div class="col-md-4 item-image" id="item-image-{{ md5($url) }}">
                <div class="float-right">
                    <button value="item-image-{{md5($url) }}" type="button" style="right:5px;position:absolute;z-index:1;" class="btn btn-danger remove-item"><i class="fa fa-trash"></i>
                    </button>
                </div>
                <input type="hidden" name="file_realestate_image[]" class="file_realestate_image" id="file_realestate_image-{{ md5($url) }}" value="{{ $url }}">
                <div class="realestate-select-image-container change_realestate_image">
                    <label class="btn-select-image">
                        <img class="realestate_image_review" id="realestate_image_review-{{ md5($url) }}" height="150" width="150" src="{{ $url }}">
                    </label>
                </div>
            </div>
            @endforeach
        @endisset
    </div>

</div>
