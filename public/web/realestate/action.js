function action(){
    this.datas=null;
    var datas=null;
    var Kilobyte = 5120;
    this.init=function(){
        var me = this;
        datas = this.datas;
        me.action();
    }
    this.runHtml = function (src,id) {
        var elm = '<div class="col-md-3 item-image" id="item-image-'+id+'">';
                        elm+='<div class="float-right">';
                            elm+='<button  value="item-image-'+id+'" type="button" style="right:5px;position:absolute;z-index:1000;" class="btn btn-danger remove-item"><i class="fa fa-trash"></i></button>';
                        elm+='</div>';
                        elm+='<input  type="hidden" name="file_realestate_image[]" class="file_realestate_image" id="file_realestate_image-'+id+'"/>';
                        elm+='<div class="realestate-select-image-container change_realestate_image">';
                            elm+='<label class="btn-select-image">';
                                elm+='<img class="realestate_image_review" id="realestate_image_review-'+id+'" height="150"  width="150" src="'+src+'"/>';
                            elm+='</label>';
                        elm+='</div>';
                    elm+='</div>';
        return elm;
    }
    this.action=function() {
        // if(datas.loai_hinh_thuc_bds=='mo_gioi'){
        //     $("__button_mo_gioi").trigger('click');
        // }else{
        //     $("__button_chu_nha").trigger('click');
        // }
        $('#realestate_mota').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            codeviewFilter: true,
            codeviewIframeFilter: true,
            codemirror: { // codemirror options
				mode: 'text/html',
				htmlMode: true,
				lineNumbers: true,
				theme: 'monokai'
			},
            height: 100,
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '30', '36', '48' , '64'],
            toolbar: [],
        });
        var me  = this;
        function setImage(file) {
            var imageCount = 0;
            $('.item-image').each(function (index,item) {
                imageCount++;
            });
            if(imageCount>5){
                $(file).val(null);
                $("#alertJSUploadImg").html(alertJS("Tối đa là 5 hình ảnh",'warning'));
                return false;
            }
            var d = new Date();
            var getTime = d.getTime();
            var imgTypeUpload = ['image/png', 'image/PNG', 'image/jpg', 'image/JPG', 'image/jpeg', 'image/JPEG', 'image/gif','image/GIF'];
            var reader = new FileReader();
            if (file.files && file.files[0]) {
                var imgType = file.files[0].type;
                var imgSize = file.files[0].size  //kB
                var KilobyteImg = Math.round((imgSize / 1024))
                if(imgTypeUpload.includes(imgType)==false){
                    $(file).val(null);
                    $("#alertJSUploadImg").html(alertJS("Hình ảnh không đúng định dạng",'warning'));
                    return false;
                }
                if(KilobyteImg>Kilobyte){
                    $(file).val(null);
                    $("#alertJSUploadImg").html(alertJS("Hình ảnh không được quá 5 MB",'dwarningnger'));
                    return false;
                }
                reader.onload = function (e) {
                    var runHtml = me.runHtml(e.target.result,getTime);
                    $("#show-item").append(runHtml);
                    $("#file_realestate_image-"+getTime).val(e.target.result);
                    $(file).val(null);
                };
                reader.readAsDataURL(file.files[0]);
            }
        }
        $(document).delegate(".change_realestate_image",'click',function(){
            var parent = $(this).parent('.item-image');
            $(parent).children('.file_realestate_image').trigger('click');
        });
		$(".file_realestate_image").on('change',function(){
            setImage(this)
        });
        $(document).delegate(".remove-item",'click',function(){
            $("#"+$(this).val()).remove();
        });
        $(document).on("keypress , paste", "#realestate_price", function (e) {
            if (/^-?\d*[,.]?(\d{0,3},)*(\d{3},)?\d{0,3}$/.test(e.key)) {
                $("#realestate_price").on("input", function () {
                    e.target.value = numberSeparator(e.target.value);
                });
            } else {
                e.preventDefault();
                return false;
            }
        });
        $(document).on("keypress , paste", "#realestate_price_rent", function (e) {
            if (/^-?\d*[,.]?(\d{0,3},)*(\d{3},)?\d{0,3}$/.test(e.key)) {
                $("#realestate_price_rent").on("input", function () {
                    e.target.value = numberSeparator(e.target.value);
                });
            } else {
                e.preventDefault();
                return false;
            }
        });
        $(".is-button").click(function(){
            $(".is-button").removeClass('active');
            var value =  $(this).val();
            if(value=='is-agent'){
                $("#loai_hinh_thuc_bds").val('moi_gioi');
                $("#is-agent").show();
            }else{
                $("#loai_hinh_thuc_bds").val('chu_nha');
                $("#is-agent").hide();
            }
            $(this).addClass('active');
        });
        $("#chinh_chu").on('click',function(){
            if($(this).is(":checked")){
                $("#show_chu_nha").hide();
            }else{
                $("#show_chu_nha").show();
            }
        });
        $("input[name=cate_type]").on('click',function(){
            var value =  $(this).val();
            if(value=='cate_buy'){
                $("#show_hidden-cang_ho_chung_cu").show();
                $("#show_hidden-nha_rieng").show();
                $("#show_hidden-dat_nen").show();
                $("#cang_ho_chung_cu").prop('checked',true);
                $("#realestate_price").attr('placeholder','Giá đề nghị ... ');
                $("#show_hidden-realestate_price_rent").hide();
                $("#shw_giatien").html('Giá đề nghị <strong class="color-red">*</strong>');
            }else{
                $("#show_hidden-cang_ho_chung_cu").show();
                $("#show_hidden-nha_rieng").show();
                $("#show_hidden-dat_nen").hide();
                $("#cang_ho_chung_cu").prop('checked',true);
                $("#realestate_price").attr('placeholder','Giá thuê ... ');
                $("#show_hidden-realestate_price_rent").show();
                $("#shw_giatien").html('Giá thuê (Tháng) <strong class="color-red">*</strong>');
            }
        });
        $("#btnPublic").on('click',function(e){
            onSubmit("#btnPublic");
        });
        function onSubmit(buton){
            $("#alertJS").empty();
            var formData = new FormData($("#formAction")[0]);
            if(!$("#chinh_chu").is(":checked")){
                formData.append('chinh_chu',"0");
            }
            if(datas.provinceID==""){
                formData.append('provinceID',$("#provinceID").val());
            }else{
                formData.append('provinceID',datas.provinceID);
            }
            if(datas.districtID==""){
                formData.append('districtID',$("#districtID").val());
            }else{
                formData.append('districtID',datas.districtID);
            }
            if(datas.wardID==""){
                formData.append('wardID',$("#wardID").val());
            }else{
                formData.append('wardID',datas.append);
            }

            var cate_type =$('input[name="cate_type"]:checked').val();
            if(cate_type=='cate_buy'){
                var category_id =$('input[name="category_id"]:checked').val();
                if(category_id=='cang_ho_chung_cu'){
                    formData.append('category_id',"7");
                }else if(category_id=='nha_rieng'){
                    formData.append('category_id',"6");
                }else{
                    formData.append('category_id',"8");
                }
            }else{
                var category_id =$('input[name="category_id"]:checked').val();
                if(category_id=='cang_ho_chung_cu'){
                    formData.append('category_id',"10");
                }else{
                    formData.append('category_id',"9");
                }
            }
            buttonloading(buton,true);
            $.ajax({
                url:$("#formAction").attr('action'),
                type: "POST",
                data:formData,
                dataType:'JSON',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.status === 'success'){
                            buttonloading(buton,false);
                            swal("Thông báo",data.msg, "success");
                            return window.location.href = datas.urlListPublic;
                    }else if(data.status === 'error'){
                            buttonloading(buton,false);
                            swal("Thông báo",data.msg, "warning");
                            $("#alertJS").html(alertJS(data.msg,'danger'));
                    }else{
                            buttonloading(buton,false);
                    }
                },
                error: function(er){
                    buttonloading(buton,false);
                    _showError(er,"#formAction");
                }
            });
        }
    }
}
