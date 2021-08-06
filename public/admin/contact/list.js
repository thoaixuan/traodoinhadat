function contact(){
    this.datas=null;
    this.showData =null;
    var showData =null;
    this.init=function(){
        var me = this;
        me.action();
    }
    this.action=function(){
        var me = this;
        $(document).delegate('.btn-delete','click',function(){
            var button = this;
            var id = $(this).data('id');
            var url = $(this).data('url');
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn xóa trang này không ?",
                data:{id:id},
                removeEL:"#item-"+id,
                reload:true
            });
        });
        $(document).delegate('.btn-status','click',function(){
            var button = this;
            var id = $(this).data('id');
            var url = $(this).data('url');
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn thay đổi trạng thái liên hệ này không ?",
                data:{id:id},
                // removeEL:"#item-"+id,
                reload:true
            });
        });

    }
}
