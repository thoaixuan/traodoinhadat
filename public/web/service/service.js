function service(){
    this.datas=null;
    this.init=function(){
        var me = this;
        me.action();
    }
    this.action=function() {
        $("#button-phaplyBDS").on('click',function(e){
            AntispamJSON.url=$(this).attr('data-url');
            AntispamJSON.form="#form-phaplyBDS";
            AntispamJSON.button=this;
            AntispamJSON.alertJS="";
            AntispamJSON.resultMath="";
            AntispamJS(AntispamJSON);
        });
        $("#button-thamdinhBDS").on('click',function(e){
            AntispamJSON.url=$(this).attr('data-url');
            AntispamJSON.form="#form-thamdinhBDS";
            AntispamJSON.button=this;
            AntispamJSON.alertJS="";
            AntispamJSON.resultMath="";
            AntispamJS(AntispamJSON);
        });
        $("#button-thutucvahosoBDS").on('click',function(e){
            AntispamJSON.url=$(this).attr('data-url');
            AntispamJSON.form="#form-thutucvahosoBDS";
            AntispamJSON.button=this;
            AntispamJSON.alertJS="";
            AntispamJSON.resultMath="";
            AntispamJS(AntispamJSON);
        });
        $("#button-dambaoTTNN").on('click',function(e){
            AntispamJSON.url=$(this).attr('data-url');
            AntispamJSON.form="#form-dambaoTTNN";
            AntispamJSON.button=this;
            AntispamJSON.alertJS="";
            AntispamJSON.resultMath="";
            AntispamJS(AntispamJSON);
        });
    }
}
