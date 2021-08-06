function slider(){
    this.datas=null;
    var Kilobyte = 5120;
    this.init=function(){
        var me = this;
        me.action();
    }
    this.action=function() {
        $("#change_slider_image").on('click',function(){
            $("#file_slider_image").val(null);
            $("#file_slider_image").trigger('click');
        });
		$("#file_slider_image").on('change',function(){
            var file = this;
            var imgTypeUpload = ['image/png', 'image/PNG', 'image/jpg', 'image/JPG', 'image/jpeg', 'image/JPEG', 'image/gif','image/GIF'];
            if (file.files && file.files[0]) {
                var reader = new FileReader();
                var imgType = file.files[0].type;
				var imgSize = file.files[0].size  //kB
                var KilobyteImg = Math.round((imgSize / 1024))
                if(imgTypeUpload.includes(imgType)==false){
                    $("#file_slider_image").val(null);
                    alert("Hình ảnh không đúng định dạng");
                    return false;
                }
                console.log("Kilobyte",Kilobyte);
                console.log("KilobyteImg",KilobyteImg);
                if(KilobyteImg>Kilobyte){
                    $("#file_slider_image").val(null);
                    alert("Hình ảnh không được quá 5 MB",'warning');
                    return false;
                }
                setImgSRC(this,"#slider_image_review");
            }
        });
        $("#onSaveSlider").on('click',function(e){
            onSubmit("#onSaveSlider");
        });

        function onSubmit(buton){
            $("#alertJS").empty();
            var formData = new FormData($("#formAction")[0]);
            formData.append('id',$('#formAction').attr('value'));
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
                    _showError(er,"#formAction");
                }
            });
        }
    }
}
