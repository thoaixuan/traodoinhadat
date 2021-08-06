function account(){
    this.datas=null;
    var datas = null;
    this.init=function(){
        var me = this;
        datas = this.datas;
        me.action();
    }
    this.action=function() {
        function LangDataTable() {
            return {
                loadingRecords: "Đang tải ....",
                // sProcessing: "<img style='width:50px; height:50px;' src='" + url_loading + "'/>",
                sLengthMenu: "Xem _MENU_ mục",
                    sZeroRecords: "Không tìm thấy dòng nào phù hợp",
                    sInfo: "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                    sInfoEmpty: "Đang xem 0 đến 0 trong tổng số 0 mục",
                    sInfoFiltered: "(được lọc từ _MAX_ mục)",
                    sInfoPostFix: "",
                    sSearch: "Tìm:",
                    sUrl: "",
                    oPaginate: {
                        sFirst: "Đầu",
                        sPrevious: "Trước",
                        sNext: "Tiếp",
                        sLast: "Cuối",
                    },
            };
        }
        $.extend(true, $.fn.dataTable.defaults, {
            language: LangDataTable()
        });
        $("#formProfile").on('submit',function(e){
            e.preventDefault();
            $("#alertJS").empty();
            var formData = new FormData(this);
            buttonloading("#onSaveProfile",true);
            $.ajax({
                url:$("#formProfile").attr('action'),
                type: "POST",
                data:formData,
                dataType:'JSON',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.status === 'success'){
                            buttonloading("#onSaveProfile",false);
                            swal("Thông báo",data.msg, "success");
                            return window.location.href = data.url;
                    }else if(data.status === 'error'){
                            buttonloading("#onSaveProfile",false);
                            swal("Thông báo",data.msg, "danger");
                    }else{
                            buttonloading("#onSaveProfile",false);
                    }
                    _showError(null,"#formProfile");
                },
                error: function(er){
                    console.log();
                    if(er.responseJSON.errors.post_content!=undefined){
                        $("#alertJS").html(alertJS(er.responseJSON.errors.post_content[0],'warning'));
                    }else{
                        $("#alertJS").empty();
                    }
                    _showError(er,"#formProfile");
                    buttonloading("#onSaveProfile",false);
                }
            });
        });

        $("#formChangePass").on('submit',function(e){
            e.preventDefault();
            $("#alertJS").empty();
            var formData = new FormData(this);
            buttonloading("#onSaveChangePass",true);
            $.ajax({
                url:$("#formChangePass").attr('action'),
                type: "POST",
                data:formData,
                dataType:'JSON',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.status === 'success'){
                            buttonloading("#onSaveChangePass",false);
                            $(".alertJSChangePass").html(alertJS(data.msg,'success'));
                            $("#old_password,#new_password,#re_password").val("");
                    }else if(data.status === 'error'){
                            buttonloading("#onSaveChangePass",false);
                            $(".alertJSChangePass").html(alertJS(data.msg,'danger'));
                    }else{
                            buttonloading("#onSaveChangePass",false);
                            $(".alertJSChangePass").html(alertJS("Máy chủ không thể thực hiện đăng ký!",'danger'));
                    }
                    setTimeout(function(){
                        $(".alertJSChangePass").empty();
                    },1200),
                    _showError(null,"#formChangePass");
                },
                error: function(er){
                    $(".alertJSChangePass").empty();
                    $(".form-control").removeClass('is-invalid');
                    _showError(er,"#formChangePass");
                    buttonloading("#onSaveChangePass",false);
                    // $("#alertJS").html(alertJS("Máy chủ không thể thực hiện đăng ký!",'danger'));
                }
            });
        });
        $(document).ready(function (params) {
            if(datas.type=='doi-mat-khau'){
                $("#doi-mat-khau-click").trigger('click')
                $(".__navtabContent").show();
            }else if(datas.type=='thong-tin-ca-nhan'){
                $("#thong-tin-ca-nhan-click").trigger('click')
                $(".__navtabContent").show();
            }else if(datas.type=='tin-da-luu'){
                $("#tin-da-luu-click").trigger('click')
                $(".__navtabContent").show();
            }else if(datas.type=='tin-da-gui'){
                $("#tin-da-gui-click").trigger('click')
                $(".__navtabContent").show();
            }else if(datas.type=='tin-da-duyet'){
                $("#tin-da-duyet-click").trigger('click')
                $(".__navtabContent").show();
            }else{
                $("#thong-tin-ca-nhan-click").trigger('click')
                $(".__navtabContent").show();
            }
        });
        $(document).delegate('.btn-delete','click',function(){
            var button = this;
            var id = $(this).data('id');
            var url = $(this).data('url');
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn xóa tin này này không ?",
                data:{id:id},
                removeEL:"#item-"+id,
                reload:true
            });
        });
        $(document).delegate('.btn-delete-tindaluu','click',function(){
            var button = this;
            var id = $(this).data('id');
            var url = $(this).data('url');
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn xóa tin này này không ?",
                data:{id:id},
                removeEL:"#item-"+id,
                reload:true
            });
        });
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
