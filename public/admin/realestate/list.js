function list(){
    this.datas=null;
    var datas=null;
    this.init=function(){
        var me = this;
        datas = this.datas;
        me.action();
    }
    this.action=function() {
        $(document).delegate('.btn-delete','click',function(){
            var button = this;
            var id = $(this).data('id');
            var url = $(this).data('url');
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn xóa vĩnh viễn bài viết này không ?",
                data:{id:id,type:'delete'},
                removeEL:"#item-"+id,
                reload:true
            });
        });
        $(document).ready(function() {
            var loadcategory = false;
            $("#cate_type").on('change',function(){
                var type = $(this).val();
                var htmlOption = '<option value=""> -- Tất cả danh mục  --</option>';
                if(type=='cate_buy'){
                    $.each(datas.buy,function (index,item) {
                        htmlOption+='<option data-form="'+item.cate_type_form+'" value="'+item.id+'">'+item.cate_name+'</option>';
                    });
                }else if(type=='cate_lease'){
                    $.each(datas.lease,function (index,item) {
                        htmlOption+='<option data-form="'+item.cate_type_form+'" value="'+item.id+'">'+item.cate_name+'</option>';
                    });
                }
                $("#category_id").html(htmlOption);
                loadcategory = true;
            });
            if(datas.cate_type!=""){
                $("#cate_type").val(datas.cate_type);
                $("#cate_type").trigger('change');
            }
            if(loadcategory){
                $("#category_id").val(datas.category_id);
                $("#category_id").trigger('change');
            }
        });
    }
}
