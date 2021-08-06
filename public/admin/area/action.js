function action() {
    this.datas=null;
    var datas = null;
    this.init=function () {
        datas = this.datas;
        this.action();
        // _modalError500();
    },
    this.action=function() {
        var me = this;
        $("#formAction").on('submit',function(e){
            e.preventDefault();
            $("#alertJS").empty();
            var buton = "#onSaveData";
            var formData = new FormData($("#formAction")[0]);
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
                    if(er.responseJSON.errors.post_content!=undefined){
                        $("#alertJS").html(alertJS(er.responseJSON.errors.post_content[0],'warning'));
                    }else{
                        $("#alertJS").empty();
                    }
                    _showError(er,"#formAction");
                }
            });
        });
        $("#provinceID").on('change',function(){
            $.ajax({
                url:datas.districtAjax,
                type: "GET",
                data:{
                    provinceID:$("#provinceID").val()
                },
                dataType:'JSON',
                success: function(data){
                    var optionHtml ='<option value="">-Chọn quận huyện-</option>';
                    $.each(data,function(index,item){
                        optionHtml+='<option value="'+item.id+'">'+item.district_name+'</option>';
                    });
                    $("#districtID").html(optionHtml);
                    $("#districtID").val(datas.districtID);
                    $("#districtID").trigger('change');
                },
                error: function(er){
                    buttonloading(buton,false);
                }
            });
        });
        if(datas.type=='ward'){
            $("#provinceID").val(datas.provinceID);
            $("#provinceID").trigger('change');

        }
    }
}
