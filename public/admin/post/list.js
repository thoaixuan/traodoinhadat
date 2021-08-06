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
        $(document).delegate('.post_status_hot','change',function(){
            var button = this;
            var id = $(this).data('id');
            var url = $(this).data('url');
            $.ajax({
                url:url,
                type:'POST',
                data:{id:id},
                dataType:'JSON',
                success:function(data){
                    Toast.fire({
                        icon: data.status,
                        title: data.msg
                    });
                    location.reload();
                },error:function(e){
                    Toast.fire({
                        icon: 'error',
                        title: "Máy chủ không thực hiện được !"
                    });
                }
            });
        });

    }
}
