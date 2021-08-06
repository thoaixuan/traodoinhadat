function action(){
    this.datas=null;
    var datas=null;
    var Kilobyte = 5120;
    this.init=function(){
        var me = this;
        datas = this.datas;
        me.action();
    }
    this.action=function() {
        $("#change_post_image").on('click',function(){
            $("#file_post_image").val(null);
            $("#file_post_image").trigger('click');
        });
		$("#file_post_image").on('change',function(){
            var file = this;
            var imgTypeUpload = ['image/png', 'image/PNG', 'image/jpg', 'image/JPG', 'image/jpeg', 'image/JPEG', 'image/gif','image/GIF'];
            if (file.files && file.files[0]) {
                var reader = new FileReader();
                var imgType = file.files[0].type;
				var imgSize = file.files[0].size  //kB
                var KilobyteImg = Math.round((imgSize / 1024))
                if(imgTypeUpload.includes(imgType)==false){
                    $("#file_post_image").val(null);
                    alert("Hình ảnh không đúng định dạng");
                    return false;
                }
                console.log("Kilobyte",Kilobyte);
                console.log("KilobyteImg",KilobyteImg);
                if(KilobyteImg>Kilobyte){
                    $("#file_post_image").val(null);
                    alert("Hình ảnh không được quá 5 MB",'warning');
                    return false;
                }
                setImgSRC(this,"#post_image_review");
            }
        });
        $('#post_content').summernote({
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
            height: $(document).height(),
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '30', '36', '48' , '64'],
            toolbar: [
				['style', ['style']],
				['font', ['bold', 'underline', 'italic', 'clear']],
				['fontname', ['fontname']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['table', ['table']],
				['insert', ['link', 'image','picture', 'video']],
				['view', ['fullscreen', 'help']]//codeview
			],


        });
        // console.log(this.datas.categorys);
        $("#category_id").on('change',function(e) {
            var htmlOption = '<option value="">-- CHỌN DANH MỤC CON --</option>';
            var id = $(this).val()+"";
            $.each(datas.subMenus,function (index,item) {
                if(id==item.cate_parentID){
                    htmlOption+= '<option value="'+item.id+'">'+item.cate_name+'</option>';
                }
            });
            $("#category_sub_id").html(htmlOption);
        })
        $("#btnPublic").on('click',function(e){
            onSubmit("#btnPublic");
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
        function onSubmit(buton){
            $("#alertJS").empty();
            var formData = new FormData($("#formAction")[0]);
            formData.set('post_content',$('#post_content').summernote('code'));
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
                            // $("#alertJS").html(alertJS("Máy chủ không thể thực hiện đăng ký!",'danger'));
                        }
                },
                error: function(er){
                    buttonloading(buton,false);
                    if(er.responseJSON.errors.post_content!=undefined){
                        $("#alertJS").html(alertJS(er.responseJSON.errors.post_content[0],'warning'));
                    }else{
                        $("#alertJS").empty();
                    }
                    if(er.responseJSON.errors.file_post_image!=undefined){
                        $("#alertJSUploadImg").html(alertJS(er.responseJSON.errors.file_post_image[0],'warning'));
                    }else{
                        $("#alertJSUploadImg").empty();
                    }
                    _showError(er,"#formAction");


                    // $("#alertJS").html(alertJS("Máy chủ không thể thực hiện đăng ký!",'danger'));
                }
            });
        }
    }
}
