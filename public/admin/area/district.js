function district() {
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
                data:{id:$(this).val(),type:'district'},
                url:route.delete,
                reload:true
            });
        });
    }
}
