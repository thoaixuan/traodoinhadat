function setting(){
    this.datas=null;
    var datas = null;
    this.init=function(){
        var me = this;
        datas = this.datas;
        me.action();
    }
    this.action=function(){
        $("#change_icon").on('click',function(){
            $("#file_icon").val(null);
            $("#file_icon").trigger('click');
        });
		$("#file_icon").on('change',function(){
            setImgSRC(this,"#icon_review");
        });
        $("#change_logo").on('click',function(){
            $("#file_logo").val(null);
            $("#file_logo").trigger('click');
        });
		$("#file_logo").on('change',function(){
            setImgSRC(this,"#logo_review");
        });
        $(".onSaveSetting").on('click',function(e){
            onSubmit(".onSaveSetting","updateSeting");
        });
        $("#testSenMail").on('click',function(e){
            onSubmit("#testSenMail","testMail");
        })
        function onSubmit(buton,type){
            $("#alertJS,#alertJSTestMail").empty();
            var formData = new FormData($("#formAction")[0]);
            formData.append('type',type);
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
                            _showError("","#formAction");
                            if(buton=='.onSaveSetting'){
                                // return window.location.href=data.url;
                            }else{
                                $("#alertJSTestMail").html(alertJS(data.msg,'success'));
                            }
                    }else if(data.status === 'error'){
                            buttonloading(buton,false);
                            if(buton=='.onSaveSetting'){
                                Toast.fire({
                                    icon: data.status,
                                    title: data.msg
                                });
                                $("#alertJS").html(alertJS(data.msg,'danger'));
                            }else{
                                $("#alertJSTestMail").html(alertJS(data.msg,'danger'));
                            }

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
        var loaddistrict = false;
        var loadpward = false;
        $(document).ready(function() {
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
                        buttonloading(buton,false);
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
                        buttonloading(buton,false);
                    }
                });
            });
            $("#provinceID").val(datas.provinceID);
            $("#provinceID").trigger('change');
            if(loaddistrict){
                $("#districtID").val(datas.districtID);
                $("#districtID").trigger('change');
            }
            if(loadpward){
                $("#wardID").val(datas.wardID);
                $("#wardID").trigger('change');
            }
        });


    }
}
