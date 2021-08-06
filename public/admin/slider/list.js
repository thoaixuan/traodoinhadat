function slider(){
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
                body:"Bạn có muốn xóa Slider này không ?",
                data:{id:id},
                removeEL:"#item-"+id,
                reload:true
            });
        });
        $(document).delegate('.slider_status','change',function(){
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
