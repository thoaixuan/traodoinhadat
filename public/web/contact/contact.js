function contact(){
    this.datas=null;
    this.init=function(){
        var me = this;
        me.action();
    }
    this.action=function() {
        $("#sendContact").on('click',function(e){
            AntispamJSON.url=$("#formAction").attr('action');
            AntispamJSON.form="#formAction";
            AntispamJSON.button=this;
            AntispamJSON.alertJS="#alertPageContact";
            AntispamJSON.resultMath="";
            AntispamJS(AntispamJSON);
        });
    }
}
