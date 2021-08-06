function seach_khuvuc(){
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
        $("#search_provinceID,#right_search_provinceID").on('change',function(){

            $.ajax({
                url:datas.districtAjax,
                type: "GET",
                data:{
                    provinceID:$('#search_provinceID option:selected').attr('data-id')
                },
                async:false,
                dataType:'JSON',
                success: function(data){
                    var optionHtml ='<option value="">-Chọn quận huyện-</option>';
                    $.each(data,function(index,item){
                        optionHtml+='<option  data-slug="'+item.district_slug+'" data-id="'+item.id+'" value="'+item.district_slug+'">'+item.district_name+'</option>';
                    });
                    $("#search_districtID,#right_search_districtID").html(optionHtml);
                    loaddistrict = true;
                },
                error: function(er){

                }
            });
        });
        $("#search_districtID,#right_search_districtID").on('change',function(){
            $.ajax({
                url:datas.wardAjax,
                type: "GET",
                data:{
                    districtID:$('#search_districtID option:selected').attr('data-id')
                },
                async:false,
                dataType:'JSON',
                success: function(data){
                    var optionHtml ='<option value="">- Chọn phường xã -</option>';
                    $.each(data,function(index,item){
                        optionHtml+='<option  data-slug="'+item.ward_slug+'" data-id="'+item.id+'" value="'+item.ward_slug+'">'+item.ward_name+'</option>';
                    });
                    $("#search_wardID,#right_search_wardID").html(optionHtml);
                    loadpward = true;
                },
                error: function(er){

                }
            });
        });
        breadcrumbs.forEach(function(value,key) {
            if(value.key=='province'){
                $("#search_provinceID,#right_search_provinceID").val(value.slug);
                $("#search_provinceID,#right_search_provinceID").trigger('change');
            }else{
                $("#search_provinceID,#right_search_provinceID").val(datas.provinceID);
                $("#search_provinceID,#right_search_provinceID").trigger('change');
            }
        });
        if(loaddistrict){
            console.log(breadcrumbs);
            breadcrumbs.forEach(function(value,key) {
                if(value.key=='district'){
                    $("#search_districtID,#right_search_districtID").val(value.slug);
                    $("#search_districtID,#right_search_districtID").trigger('change');
                }else{
                    $("#search_districtID,#right_search_districtID").val(datas.districtID);
                    $("#search_districtID,#right_search_districtID").trigger('change');
                }
            });
        }
        if(loadpward){
            console.log(breadcrumbs);
            breadcrumbs.forEach(function(value,key) {
                if(value.key=='ward'){
                    $("#search_wardID,#right_search_wardID").val(value.slug);
                    $("#search_wardID,#right_search_wardID").trigger('change');
                }else{
                    $("#search_wardID,#right_search_wardID").val(datas.wardID);
                    $("#search_wardID,#right_search_wardID").trigger('change');
                }
            });
        }


    }
}
