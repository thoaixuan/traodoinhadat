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
        var elm = '<div class="col-md-4 item-image" id="item-image-'+id+'">';
                        elm+='<div class="float-right">';
                            elm+='<button  value="item-image-'+id+'" type="button" style="right:5px;position:absolute;z-index:1;" class="btn btn-danger remove-item"><i class="fa fa-trash"></i></button>';
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
        var me  = this;
        function itemImage() {

        }
        function setImage(file) {
            var imageCount = 0;
            $('.item-image').each(function (index,item) {
                imageCount++;
            });
            imageCount--;
            var d = new Date();
            var getTime = d.getTime();
            var imgTypeUpload = ['image/png', 'image/PNG', 'image/jpg', 'image/JPG', 'image/jpeg', 'image/JPEG', 'image/gif','image/GIF'];
            var reader = new FileReader();
            if(imageCount>5){
                $(file).val(null);
                $("#alertJSUploadImg").html(alertJS("Tối đa là 5 hình ảnh",'warning'));
                return false;
            }
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
                    $("#alertJSUploadImg").html(alertJS("Hình ảnh không được quá 5 MB",'warning'));
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
        $(document).on("keypress , paste", "#realestate_price,#send_realestate_price_rent,#trans_price", function (e) {
			if (/^-?\d*[,.]?(\d{0,3},)*(\d{3},)?\d{0,3}$/.test(e.key)) {
				$("#realestate_price,#send_realestate_price_rent,#trans_price").on("input", function () {
					e.target.value = numberSeparator(e.target.value);
				});
			} else {
				e.preventDefault();
				return false;
			}
		});
        
        $(document).on("keypress , paste", "#realestate_dat_dien_tich,#realestate_nha_chieudai,#realestate_nha_chieurong", function (e) {
			if (/^-?\d*[,.]?(\d{0,3},)*(\d{3},)?\d{0,3}$/.test(e.key)) {
                e.target.value = e.target.value;
            }else {
				e.preventDefault();
				return false;
			}
        });
        $("#category_id").on('change',function(e){
            var type = $('#category_id option:selected').attr('data-form');
            if(type==='NHA'){
                $(".NHA").show();
                $(".DAT").hide();
            }else{
                $(".NHA").hide();
                $(".DAT").show();
            }
        });
        $('#realestate_mota,#realestate_tien_ich').summernote({
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
            height: 200,
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '30', '36', '48' , '64'],
            toolbar: [
				['style', ['style']],
				['font', ['bold', 'underline', 'italic', 'clear']],
				['fontname', ['fontname']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['table', ['table']],
				['insert', ['link']],
				['view', ['fullscreen', 'help']]
			],
        });
        $("#btnPublic").on('click',function(e){
            onSubmit("#btnPublic");
        });
        var loaddistrict = false;
        var loadpward = false;
        var loadcategory = false;
        $(document).ready(function() {
            $("#cate_type").on('change',function(){
                var type = $(this).val();
                var htmlOption = '<option value=""> -- Chọn danh mục  --</option>';
                if(type=='cate_buy'){
                    $.each(datas.buy,function (index,item) {
                        htmlOption+='<option data-form="'+item.cate_type_form+'" value="'+item.id+'">'+item.cate_name+'</option>';
                    });
                }else if(type=='cate_lease'){
                    $.each(datas.lease,function (index,item) {
                        htmlOption+='<option data-form="'+item.cate_type_form+'" value="'+item.id+'">'+item.cate_name+'</option>';
                    });
                }else if(type=='cate_project'){
                    $.each(datas.project,function (index,item) {
                        htmlOption+='<option data-form="'+item.cate_type_form+'" value="'+item.id+'">'+item.cate_name+'</option>';
                    });
                }
                $("#category_id").html(htmlOption);
                loadcategory = true;
                if(type=='cate_lease'){
                    $("#span_realestate_price").html('Giá tiền cho thuê <span class="text-danger">*</span>');
                    $("#showhidden_send_realestate_price_rent").show();
                }else if(type=='cate_buy'){
                    $("#span_realestate_price").html('Giá tiền đề nghị <span class="text-danger">*</span>');
                    $("#showhidden_send_realestate_price_rent").hide();
                    $("#send_realestate_price_rent").val("");
                }
            });
            $("#cate_type").val(datas.cate_type);
            $("#cate_type").trigger('change');
            $("#provinceID").on('change',function(){
                $.ajax({
                    url:datas.districtAjax,
                    type: "GET",
                    data:{
                        provinceID:$("#provinceID").val()
                    },
                    async:false,
                    dataType:'JSON',
                    success: function(data){
                        var optionHtml ='<option value="">-Chọn quận huyện-</option>';
                        $.each(data,function(index,item){
                            optionHtml+='<option value="'+item.id+'">'+item.district_name+'</option>';
                        });
                        $("#districtID").html(optionHtml);
                        loaddistrict = true;
                    },
                    error: function(er){

                    }
                });
            });
            $("#districtID").on('change',function(){
                $.ajax({
                    url:datas.wardAjax,
                    type: "GET",
                    data:{
                        districtID:$("#districtID").val()
                    },
                    async:false,
                    dataType:'JSON',
                    success: function(data){
                        var optionHtml ='<option value="">- Chọn phường xã -</option>';
                        $.each(data,function(index,item){
                            optionHtml+='<option value="'+item.id+'">'+item.ward_name+'</option>';
                        });
                        $("#wardID").html(optionHtml);
                        loadpward = true;
                    },
                    error: function(er){

                    }
                });
            });
            $("#provinceID").val(datas.provinceID);
            $("#provinceID").trigger('change');
            if(loadcategory){
                console.log(datas.category_id);
                $("#category_id").val(datas.category_id);
                $("#category_id").trigger('change');
            }
            if(loaddistrict){
                $("#districtID").val(datas.districtID);
                $("#districtID").trigger('change');
            }
            if(loadpward){
                $("#wardID").val(datas.wardID);
                $("#wardID").trigger('change');
            }
        });
        if(datas.type=='update'){
            $("#category_id").val(datas.category_id);
            $("#category_id").trigger('change');
            $.each(datas.subMenus,function (index,item) {
                if(datas.category_id+""==item.id+""){
                    $("#category_id").val(item.cate_parentID);
                    $("#category_id").trigger('change');
                    $("#category_sub_id").val(datas.category_id);
                    $("#category_sub_id").trigger('change');
                }
            });
        }
        function showError(er) {
            if(er.status==422 ){
                var errors = er.responseJSON.errors;
                var html = '';
                var i = 0;
                $.each(errors,function(key,value){
                    i++;
                    html+='<span>'+i+". "+value[0]+'</span><br>';
                });
                $(".thong-bao-loi").show();
                $("#error-detail").html(alertJS(html,'success'));
            }else{
                $("#error-detail").empty();
                $(".thong-bao-loi").hide();
            }

        }
        function onSubmit(buton){
            $("#alertJS").empty();
            var formData = new FormData($("#formAction")[0]);
            formData.set('realestate_tien_ich',$('#realestate_tien_ich').summernote('code'));
            formData.set('realestate_mota',$('#realestate_mota').summernote('code'));
            formData.append('id',$('#formAction').attr('value'));
            // formData.append('tags',JSON.stringify($("#tags").tagsinput('items')));
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
                            Toast.fire({
								icon: data.status,
								title: data.msg
							});
                            return window.location.href=data.url;
                    }else if(data.status === 'error'){
                            buttonloading(buton,false);
                            Toast.fire({
								icon: data.status,
								title: data.msg
							});
                            $("#alertJS").html(alertJS(data.msg,'danger'));
                    }else{
                            buttonloading(buton,false);
                        }
                },
                error: function(er){
                    buttonloading(buton,false);
                    showError(er);
                    _showError(er,"#formAction");
                }
            });
        }
    }
}
/*Remove white space text area */
$( document ).ready(function() {
    //$("#remove_whitespace").trim();
    $('#remove_whitespace').each(function(){
        $(this).val($(this).val().trim());
    });
});