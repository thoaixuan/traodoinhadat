function ward() {
    this.datas=null;
    this.routes=null;
    var route = null;
    var data = null;
    var table =null;
    this.init=function () {
        data = this.datas;
        route = this.routes;
        this.action();
        // _modalError500();
    },
    this.action=function() {
        var me = this;
        $(document).delegate(".btn-delete","click",function(){
            _modalDelete({
                data:{id:$(this).val(),type:'ward'},
                url:route.delete,
                reload:true
            });
        });
        $("#provinceID").on('change',function(){
            $.ajax({
                url:route.districtAjax,
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
                },
                error: function(er){
                    buttonloading(buton,false);
                }
            });
        });
    }
}
