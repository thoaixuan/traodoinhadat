function khuvuc(){
    this.datas=null;
    var datas=null;
    this.init=function(){
        var me = this;
        datas = this.datas;
        me.action();
    }
    this.action=function() {
        var me  = this;
        var loaddistrict = false;
        var loadpward = false;
        var loadcategory = false;
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
    }
}
