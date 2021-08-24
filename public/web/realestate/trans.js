/*------------------------- TRAO DOI NHA DAT ----------------------------*/  
function trans(){
    this.datas=null;
    var datas=null;
    //var Kilobyte = 5120;
    this.init=function(){
        var me = this;
        datas = this.datas;
        me.action();
    }
    this.action=function() {
        $('#realestate_mota').summernote({
            placeholder: 'Enter Content',
            tabsize: 2,
            codeviewFilter: true,
            codeviewIframeFilter: true,
            codemirror: { // codemirror options
				mode: 'text/html',
				htmlMode: true,
				lineNumbers: true,
				theme: 'monokai'
			},
            height: 100,
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '30', '36', '48' , '64'],
            toolbar: [],
        });
        
        $("input[name=cate_type]").on('click',function(){
            var value =  $(this).val();
            if(value=='cate_buy'){
                $("#show_hidden-cang_ho_chung_cu").show();
                $("#show_hidden-nha_rieng").show();
                $("#show_hidden-dat_nen").show();
                $("#cang_ho_chung_cu").prop('checked',true);
                $("#realestate_price").attr('placeholder','Giá đề nghị ... ');
                $("#show_hidden-realestate_price_rent").hide();
                $("#shw_giatien").html('Giá đề nghị <strong class="color-red">*</strong>');
            }else{
                $("#show_hidden-cang_ho_chung_cu").show();
                $("#show_hidden-nha_rieng").show();
                $("#show_hidden-dat_nen").hide();
                $("#cang_ho_chung_cu").prop('checked',true);
                //$("#realestate_price").attr('placeholder','Giá thuê ... ');
                //$("#show_hidden-realestate_price_rent").show();
                //$("#shw_giatien").html('Giá thuê (Tháng) <strong class="color-red">*</strong>');
            }
        });
        $("#btn-transsend").on('click',function(e){
            onSubmit("#btn-transsend");
        });
        function onSubmit(buton){
            $("#alertJS").empty();
            var formData = new FormData($("#formActionTrans")[0]);
            
            if(datas.provinceID==""){
                formData.append('provinceID',$("#provinceID").val());
            }else{
                formData.append('provinceID',datas.provinceID);
            }
            if(datas.districtID==""){
                formData.append('districtID',$("#districtID").val());
            } else{ formData.append('districtID',datas.districtID); }
            if(datas.wardID==""){
                formData.append('wardID',$("#wardID").val());
            }else{
                formData.append('wardID',datas.append);
            }

            var cate_type =$('input[name="cate_type"]:checked').val();
            if(cate_type=='cate_buy'){
                var category_id =$('input[name="category_id"]:checked').val();
                if(category_id=='cang_ho_chung_cu'){  formData.append('category_id',"7"); }
                else if(category_id=='nha_rieng'){ formData.append('category_id',"6"); }
                else{ formData.append('category_id',"8"); }
            }else{
                var category_id =$('input[name="category_id"]:checked').val();
                if(category_id=='cang_ho_chung_cu'){ formData.append('category_id',"10"); }
                else{ formData.append('category_id',"9"); }
            }
            buttonloading(buton,true);
            $.ajax({
                url:$("#formActionTrans").attr('action'),
                type: "POST",
                data:formData,
                dataType:'JSON',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.status === 'success'){
                            buttonloading(buton,false);
                            swal("Thông báo",data.msg, "success");
                            return window.location.href = datas.redirectSendSuccess;
                    }else if(data.status === 'error'){
                            buttonloading(buton,false);
                            swal("Thông báo",data.msg, "warning");
                            $("#alertJS").html(alertJS(data.msg,'danger'));
                    }else{
                            buttonloading(buton,false);
                    }
                },
                error: function(er){
                    buttonloading(buton,false);
                    _showError(er,"#formActionTrans");
                }
            });
        }
    }
}
