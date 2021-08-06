function search_header(){
    this.datas=null;
    var datas=null;
    this.init=function(){
        var me = this;
        datas = this.datas;
        me.action();
    }
    this.action=function() {
        function catetype(params) {
            if(params=='cate_buy') return 'mua';
            if(params=='cate_lease') return 'thue';
            if(params=='cate_project') return 'du-an';
        }
        var me  = this;
        $(".list-group-item-action").on('click',function(params) {
            var cate_type = $(this).attr('data-value');
            if(cate_type=='cate_type'){
                $('#detail_search').hide();
            }else{
                $('#detail_search').show();
            }
            $("#search_cate_type,#right_search_cate_type").val(cate_type);
            $("#search_cate_type,#right_search_cate_type").trigger('change');
        });
        $("#search_cate_type,#right_search_cate_type").on('change',function(){
            var type = $(this).val();
            var htmlOption = '<option value="">Tất cả</option>';
            if(type=='cate_buy'){
                 $('#detail_search').show();
                $.each(datas.buy,function (index,item) {
                    htmlOption+='<option data-slug="'+item.cate_slug+'" data-form="'+item.cate_type_form+'" value="'+item.cate_slug+'">'+item.cate_name+'</option>';
                });
            }else if(type=='cate_lease'){
                 $('#detail_search').show();
                $.each(datas.lease,function (index,item) {
                    htmlOption+='<option data-slug="'+item.cate_slug+'" data-form="'+item.cate_type_form+'" value="'+item.cate_slug+'">'+item.cate_name+'</option>';
                });
            }else if(type=='cate_project'){
                $('#detail_search').hide();
                $.each(datas.project,function (index,item) {
                    htmlOption+='<option data-slug="'+item.cate_slug+'" data-form="'+item.cate_type_form+'" value="'+item.cate_slug+'">'+item.cate_name+'</option>';
                });
            }
            $("#search_category_id,#right_search_category_id").html(htmlOption);
            breadcrumbs.forEach(function(value,key) {
                if(value.key=='category'){
                    $("#search_category_id,#right_search_category_id").val(value.slug);
                }
            });
        });
        $("#search_cate_type,#right_search_cate_type").val(datas.cate_type);
        $("#search_cate_type,#right_search_cate_type").trigger('change');
        $("#btn-search").on('click',function(){
            var url =datas.urlSearch;
            var cate_type = $("#search_cate_type").val();
            if(cate_type){
                url+="/"+catetype(cate_type);
            }
            var category = $('#search_category_id option:selected').attr('data-slug');
            if(category){
                url+="/"+category;
            }
            var province = $('#search_provinceID option:selected').attr('data-slug');
            if(province){
                url+="/"+province;
            }
            var district = $('#search_districtID option:selected').attr('data-slug');
            if(district){
                url+="/"+district;
            }
            var ward = $('#search_wardID option:selected').attr('data-slug');
            if(ward){
                url+="/"+ward;
            }
            url+="?";
            var search_query = $("#search_query").val();
            if(search_query){
                url+="q="+search_query;
            }
            var min = $("#realestate_dat_dientich option:selected").attr('data-min-size');
            var max = $("#realestate_dat_dientich option:selected").attr('data-max-size');
            if(min&&max){
                url+="&min="+min;
                url+="&max="+max;
            }
            var realestate_nha_hem = $("#realestate_nha_hem").val();
            if(realestate_nha_hem){
                url+="&hem="+realestate_nha_hem;
            }
            var realestate_nha_huong = $("#realestate_nha_huong").val();
            if(realestate_nha_huong){
                url+="&huong="+realestate_nha_huong;
            }
            var dacbiet = $('#dac-biet:checked').val();
            if(dacbiet){
                url+="&dacbiet="+dacbiet;
            }
            var dathamdinh = $('#da-tham-dinh:checked').val();
            if(dathamdinh){
                url+="&dathamdinh="+dathamdinh;
            }
            var daban = $('#da-ban:checked').val();
            if(daban){
                url+="&daban="+daban;
            }
            var tan = $("#tan").val();
            if(tan){
                url+="&tan="+tan;
            }
            var phongngu = $("#phong-ngu").val();
            if(phongngu){
                url+="&phongngu="+phongngu;
            }
            var phongtam = $("#phong-tam").val();
            if(phongtam){
                url+="&phongtam="+phongtam;
            }
            // alert(url);
            return window.location.href =url;
        });
        $("#right_btn-search").on('click',function(){
            var url =datas.urlSearch;
            var cate_type = $("#right_search_cate_type").val();
            if(cate_type){
                url+="/"+catetype(cate_type);
            }
            var category = $('#right_search_category_id option:selected').attr('data-slug');
            if(category){
                url+="/"+category;
            }
            var province = $('#right_search_provinceID option:selected').attr('data-slug');
            if(province){
                url+="/"+province;
            }
            var district = $('#right_search_districtID option:selected').attr('data-slug');
            if(district){
                url+="/"+district;
            }
            var ward = $('#right_search_wardID option:selected').attr('data-slug');
            if(ward){
                url+="/"+ward;
            }
            var search_query = $("#search_query").val();
            if(search_query){
                url+="q="+search_query;
            }else{
                url+="?q=";
            }
            var min = $("#right_realestate_dat_dientich option:selected").attr('data-min-size');
            var max = $("#right_realestate_dat_dientich option:selected").attr('data-max-size');
            if(min&&max){
                url+="&min="+min;
                url+="&max="+max;
            }
            var realestate_nha_hem = $("#right_realestate_nha_hem").val();
            if(realestate_nha_hem){
                url+="&hem="+realestate_nha_hem;
            }
            var realestate_nha_huong = $("right_#realestate_nha_huong").val();
            if(realestate_nha_huong){
                url+="&huong="+realestate_nha_huong;
            }
            var tan = $("#right_tan").val();
            if(tan){
                url+="&tan="+tan;
            }
            var phongngu = $("#right_phong-ngu").val();
            if(phongngu){
                url+="&phongngu="+phongngu;
            }
            var phongtam = $("#right_phong-tam").val();
            if(phongtam){
                url+="&phongtam="+phongtam;
            }
            // alert(url);
            return window.location.href =url;
        });
        breadcrumbs.forEach(function(value,key) {
            if(value.key=='cateType'&&value.name!=null){
                if(value.slug=='gui-bat-dong-san'){
                    $("#search_cate_type,#right_search_cate_type").val("cate_buy");
                    $("#search_cate_type,#right_search_cate_type").trigger('change');
                }else{
                    $("#search_cate_type,#right_search_cate_type").val(value._slug);
                    $("#search_cate_type,#right_search_cate_type").trigger('change');
                }
            }
        });
    }
}
