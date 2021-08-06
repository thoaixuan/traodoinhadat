function page(){
    this.datas=null;
    this.init=function(){
        var me = this;
        me.action();
    }
    this.action=function() {
        $('#post_content').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            codeviewFilter: true,
            codeviewIframeFilter: true,

            height: $(document).height(),
            toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'help']]
            ]
        });
        $("#btnPublic").on('click',function(e){
            onSubmit("#btnPublic");
        });
        function onSubmit(buton){
            $("#alertJS").empty();
            var formData = new FormData($("#formAction")[0]);
            formData.set('post_content',$('#post_content').summernote('code'));
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
                    _showError(er,"#formAction");


                    // $("#alertJS").html(alertJS("Máy chủ không thể thực hiện đăng ký!",'danger'));
                }
            });
        }
    }
}
