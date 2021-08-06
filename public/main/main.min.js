var optionDelete ={
	title:"Thông báo",
	body:"Có chắc chắn muốn xóa không !",
	textCancel:"Hủy bỏ",
	textConfirm:"Xắc nhận",
	method:'POST',
	url:'',
	data:{},
	table:null,
    emptyEL:null,
    removeEL:null,
    reload:false
}
function merge(a, b) {
	return $.merge($.merge([], a), b);
}
function numberSeparator(Number) {
	var commaCounter = 10;
	Number += '';
	for (var i = 0; i < commaCounter; i++) {
		Number = Number.replace(',', '');
	}

	x = Number.split('.');
	y = x[0];
	z = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;

	while (rgx.test(y)) {
		y = y.replace(rgx, '$1' + ',' + '$2');
	}
	commaCounter++;
	return y + z;
}
function _modalDelete(obj) {
    console.log(obj);
	if(obj!=undefined){
		if(obj.title!=undefined){
			optionDelete.title = obj.title;
		}
		if(obj.body!=undefined){
			optionDelete.body = obj.body;
		}
		if(obj.textCancel!=undefined){
			optionDelete.textCancel = obj.textCancel;
		}
		if(obj.textConfirm!=undefined){
			optionDelete.textConfirm = obj.textConfirm;
		}
		if(obj.method!=undefined){
			optionDelete.method = obj.method;
		}
        if(obj.type!=undefined){
			optionDelete.method = obj.type;
		}
		if(obj.url!=undefined){
			optionDelete.url = obj.url;
		}
		if(obj.data!=undefined){
			optionDelete.data = obj.data;
		}
		if(obj.table!=undefined){
			optionDelete.table = obj.table;
		}
        if(obj.removeEL!=undefined){
			optionDelete.removeEL = obj.removeEL;
		}
        if(obj.emptyEL!=undefined){
			optionDelete.emptyEL = obj.emptyEL;
		}
        if(obj.reload!=undefined){
            optionDelete.reload = obj.reload;
        }
		if(optionDelete.url==''){
			$("#errorAlert").remove();
			var html='<div class="alert alert-danger" id="errorAlert">'
				html+='<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>';
				html+='Chưa có data ! _modalDelete({..})';
			html+='</div>';
			$("#delete-body").prepend(html);
			$("#modalDelete").modal('show');
		}else{
			$("#delete-title").html(optionDelete.title);
			$("#delete-body").html(optionDelete.body);
			$("#delete-button-cancel").html(optionDelete.textCancel);
			$("#delete-button-confirm").html(optionDelete.confirm);
			$("#modalDelete").modal('show');
		}
	}else{
		alert("Chưa có data ! _modalDelete({..})");
		return;
	}

}
function _modalError500(error){
	console.log(error);
	$("#errorAlert").remove();
	if(error.responseJSON.message==''){
		error.responseJSON.message = error.statusText
	}
	var html='<div class="alert alert-danger" id="errorAlert">'
		html+='<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>';
		html+=error.responseJSON.message;
	html+='</div>';
	$(".modal-body").prepend(html);
}
function _buttonActionDropdown(data){

	var htmlButton='<div class="btn-group ">';
		htmlButton+='<button data-toggle="dropdown" class="btn btn-info btn-white dropdown-toggle" aria-expanded="true">	<i class="fa fa-cog"></i></button>';
		htmlButton+='<ul class="dropdown-menu dropdown-info dropdown-menu-right">';
			 $.each(data,function(index,item){
				if(item.icon==undefined){
					item.icon = '';
				}
				if(item.title==undefined){
					item.title = item.text;
				}
                htmlButton+='<li><button class="btn btn-xs btn-block  '+item.class+'" '+item.attr+'  value="'+item.value+'" title="'+item.title+'">'+item.icon+'&nbsp;'+item.text+'</button></li>';
            });
		htmlButton+='</ul>';
	 htmlButton+='</div>';
    return htmlButton;
}
function _buttonActionButton(data){
		var htmlButton='<div class="btn-group">'
			 $.each(data,function(index,item){
				if(item.icon==undefined){
					item.icon = '';
				}
				if(item.text==undefined){
					item.text = '';
				}
				if(item.title==undefined){
					item.title = item.text;
				}
				htmlButton+='<button class="btn btn-xs  '+item.class+'" '+item.attr+'  value="'+item.value+'" title="'+item.title+'">'+item.icon+'&nbsp;'+item.text+'</button></li>';
			 });
		htmlButton+='</div>';
		return htmlButton;
}
function _showError(er,form){
	if(form==undefined){form ="";}
	$(".is-invalid").addClass('is-valid');
	$(".is-invalid").removeClass('is-invalid');
	$(".invalid-feedback").remove();
	if(er.status==422 ){
		var errors = er.responseJSON.errors;
		$.each(errors,function(key,value){
			var input = 	$(form+" input[name="+key+"]");
			var textarea = 	$(form+" textarea[name="+key+"]");
			var select = 	$(form+" select[name="+key+"]");
			if(input){
				input.addClass('is-invalid');
				if(input.parent('.form-group')){
					input.parent('.form-group').append('<span  class="error invalid-feedback"><i class="far fa-times-circle"></i> '+value[0]+'</span>');
				}
				if(input.parent('.input-group').parent('.form-group')){
					input.parent('.input-group').parent('.form-group').append('<span  class="error invalid-feedback"><i class="far fa-times-circle"></i> '+value[0]+'</span>');
				}

			}else{
				$(input).removeClass('is-invalid');
			}
			if(textarea){
				textarea.addClass('is-invalid');
				if(textarea.parent('.form-group')){
					textarea.parent('.form-group').append('<span  class="error invalid-feedback"><i class="far fa-times-circle"></i> '+value[0]+'</span>');
				}else if(textarea.parent('.input-group').parent('.form-group')){
					textarea.parent('.input-group').parent('.form-group').append('<span  class="error invalid-feedback"><i class="far fa-times-circle"></i> '+value[0]+'</span>');
				}
			}else{
				$(textarea).removeClass('is-invalid');
			}
			if(select){
				select.addClass('is-invalid');
				if(select.parent('.form-group')){
					select.parent('.form-group').append('<span  class="error invalid-feedback"><i class="far fa-times-circle"></i> '+value[0]+'</span>');
				}else if(select.parent('.input-group').parent('.form-group')){
					select.parent('.input-group').parent('.form-group').append('<span  class="error invalid-feedback"><i class="far fa-times-circle"></i> '+value[0]+'</span>');
				}
			}else{
				$(select).removeClass('is-invalid');
			}
		});
	}
}
function reloadTable(e){
	$(e).DataTable().ajax.reload();
}
function buttonloading(e, type) {
    if (type == true) {
        console.log(type);
		if (!$(e).children("span").hasClass("loadding")) {
			$(e).attr("disabled", type);
            $(e).prepend('<span  class="loadding spinner-border spinner-border-sm mr-1"></span>');
			$(e).children('i').hide();
		}
	} else {
        console.log(type);

		if ($(e).children("span").hasClass("loadding")) {
			$(e).children("span").remove();
			$(e).attr("disabled", type);
			$(e).children('i').show();
		}
	}
}
function LangDataTable() {
	return {
		loadingRecords: "Đang tải ....",
		sProcessing: "<img style='width:50px; height:50px;' src='" + url_loading + "'/>",
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
function echo(e){
    if(e==null||e==''){
        return '';
    }else{
        return e;
    }
}
var Lang = 'vi';
var dateRangePickerLocale = Lang == "en"?{
		format: "DD-MM-YYYY",
		customRangeLabel: "Custom",
		applyLabel: "Select",
		cancelLabel: "Delete",
}:{
		format: "DD-MM-YYYY",
		customRangeLabel: "Tùy Chọn",
		applyLabel: "Chọn",
		cancelLabel: "Xóa",
};
function daterange(daterange,dateBegin,dateEnd,type){

	var begin = moment(moment().startOf(type)).format("YYYY-MM-DD");
	var end = moment(moment().endOf(type)).format("YYYY-MM-DD");
	$(dateBegin).val(begin);
	$(dateEnd).val(end);
	$(daterange).daterangepicker({
		ranges   : {
			// 'Từ trước đến nay'  : ['', ''],
			'Tháng này'  : [moment().startOf('month'), moment().endOf('month')],
			'Tháng trước'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
			'Hôm nay'       : [moment(), moment()],
			'Hôm qua'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'7 Ngày qua' : [moment().subtract(6, 'days'), moment()],
			'30 ngày trước': [moment().subtract(29, 'days'), moment()],
			'Năm nay'  : [moment().startOf('year'), moment().endOf('year')],
			'Năm trước'  : [moment().subtract(1, 'year').startOf('year'),moment().subtract(1, 'year').endOf('year')],
		},
		locale: dateRangePickerLocale,
		startDate: moment(moment().startOf(type), "DD-MM-YYYY"),
		endDate: moment(moment().endOf(type), "DD-MM-YYYY"),
		language:Lang,
	},
	function (start, end,label) {
		$(".daterangepicker_label").val(label);
		if(start._isValid==false||end._isValid==false){
			$(daterange).attr('readonly',true);
			$(dateBegin).val("");
			$(dateEnd).val("");
		}else{
			$(dateBegin).val(start.format("YYYY-MM-DD"));
			$(dateEnd).val(end.format("YYYY-MM-DD"));
			$(daterange).attr('readonly',false);
		}
	}
   );
}
daterange('#daterange','#dateBegin','#dateEnd',show_data);


function input_money_format(e) {
$(e).val($(e).val().replace(/\D/gm, ""));
var val = $(e).val().split(",").join("");
e.value = val.toString().split(/(?=(?:\d{3})+(?:\.|$))/g).join(",");
}
function money_format_to_number(e) {

if(e==null||e==''){
	return '';
}else{
	return parseFloat(e.toString().replace(/,/g, ""));
}
}
function money_format(e) {

if(e==null||e==''){
	return '';
}else{
	return e.toString().split(/(?=(?:\d{3})+(?:\.|$))/g).join(",");
}

}
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
function thongbao(icon,messages){
    Toast.fire({
        icon: icon,
        title:messages
    });
}
function null_to_number(e){
    if(e==null||e=='null'){
        return 0;
    }else{
        return e;
    }
}
function init_tinymce(selector, min_height) {
	var menu_bar = "file edit view insert format tools table help";
	if (selector == ".tinyMCEQuiz") {
		menu_bar = false;
	}
	tinymce.init({
		// inline: true,
		selector: selector,
		min_height: min_height,
		valid_elements: "*[*]",
		relative_urls: false,
		remove_script_host: false,
		language: "vi",
		menubar: menu_bar,
		plugins: [
			"advlist autolink lists link image charmap print preview anchor",
			"searchreplace visualblocks code codesample fullscreen",
			"insertdatetime media table paste imagetools",
		],
		toolbar:
			"fullscreen code preview | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | numlist bullist | forecolor backcolor removeformat | image media link | outdent indent",
		content_css: [editor_content_css],
		codesample_languages: [
			{ text: "HTML/XML", value: "markup" },
			{ text: "JavaScript", value: "javascript" },
			{ text: "CSS", value: "css" },
			{ text: "PHP", value: "php" },
			{ text: "Ruby", value: "ruby" },
			{ text: "Python", value: "python" },
			{ text: "Java", value: "java" },
			{ text: "C", value: "c" },
			{ text: "C#", value: "csharp" },
			{ text: "C++", value: "cpp" },
		],
	});
	tinymce.DOM.loadCSS(editor_ui_css);
}
function changeDarkMode(url,type){
    $.ajax({
        url:url,
        type:'POST',
        dataType:'JSON',
        data:{type:type},
        success:function(data){

        },error:function(error){

        }
    });
}
function readImage(inputElement) {
	// console.log(inputElement);
    var deferred = $.Deferred();
    var files = inputElement.get(0).files;
    if (files && files[0]) {
        var fr = new FileReader();
        fr.onload = function (e) {
            deferred.resolve(e.target.result);
        };
        fr.readAsDataURL(files[0]);
    } else {
        deferred.resolve(undefined);
    }
    return deferred.promise();
}
function setImgSRC(InputFile, img) {
    readImage($(InputFile)).done(function (base64Data) {
        $(img).attr('src', base64Data);
    });
}
function setImgAttr(InputFile, elm) {
    readImage($(InputFile)).done(function (base64Data) {
        $(elm).attr('style',"background-image: url("+base64Data+")");
    });
}
function colorStatus(e){

    if(e=='1') return "text-primary";
    if(e=='2') return "text-danger";
    if(e=='3') return "text-done";
    return "";
}
function alertJS(message,type) {
    var alerthtml = '<div class="alert alert-'+type+' text-small alert-dismissible" role="alert">';
    alerthtml += '' + message + '';
    alerthtml += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    alerthtml += '<span aria-hidden="true">&times;</span>';
    alerthtml += '</button>';
    alerthtml += '</div>'
    return alerthtml;
}
function removeEL() {
    if(optionDelete.removeEL!=null){
        $(optionDelete.removeEL).remove();
    }

}
function emptyEL() {
    if(optionDelete.emptyEL!=null){
        $(optionDelete.emptyEL).empty();
    }
}
function reloadPage() {
    if(optionDelete.reload==true){
        location.reload();
    }
}
$(document).ready(function() {
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } });
    $(".select2").select2({
        width:'100%'
    });
    $('.count').each(function () {
        $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
        }, {
            duration: 1000,
            easing: 'swing',
            step: function (now) {
                    $(this).text(Math.ceil(now));
            }
        });
    });
	var pathname = window.location.href;
    console.log(pathname);
    var elmParent =  $('.nav-sidebar > .nav-item  > a[href="'+pathname+'"]');
    elmParent.addClass('active');
    console.log(elmParent);
    var elmParent =  $('.nav-treeview > .nav-item > a[href="'+pathname+'"]');
    elmParent.addClass('active')
    elmParent.parents('.has-treeview').children().addClass('active')
    elmParent.parents('.has-treeview').addClass('active menu-open')
    elmParent.parent().parent().attr('style','display: block;').parent().addClass('active');
    elmParent.addClass('active ');
	$("#delete-button-confirm").on('click',function(){
		buttonloading('#delete-button-confirm',true);
		$.ajax({
			url:optionDelete.url,
			type:optionDelete.method,
			dataType:'JSON',
			data:optionDelete.data,
			success:function(data) {
				buttonloading('#delete-button-confirm',false);
				if(data.status=='success'){
                    reloadTable(optionDelete.table);
					$("#modalDelete").modal('hide');
					Toast.fire({
                        icon: data.status,
                        title: data.msg
                    });
                    emptyEL();
                    removeEL();
                    reloadPage();
				}else if(data.status=='error'){
					Toast.fire({
                        icon: data.status,
                        title: data.msg
                    });
				}
			},error:function(error){
				console.log(error);
				buttonloading('#delete-button-confirm',false);
				_modalError500(error);
			}
		});
	});
    $(".button-logout").on('click',function(e){
        e.preventDefault();
		$.ajax({
			url:$(this).attr('href'),
			type:'GET',
			dataType:'JSON',
			success:function(data) {
                location.reload();
			},error:function(error){
                alert("Not logout !")
			}
		})
	});
	$("#changeDarkMode").on('click',function(){
		var type = $(this).attr('data-darkmode');
		var url = $(this).attr('data-url');
		$(this).attr('data-darkmode',type=='on'?'off':'on');
		if(type=='on'){
			changeDarkMode(url,'on')
			$("#bodyClass").addClass('dark-mode');
			$("#logoOff,#logoDarkmodeOff").addClass('d-none');
			$("#logoOn,#logoDarkmodeOn").removeClass('d-none');
		}else{
			changeDarkMode(url,'off')
			$("#bodyClass").removeClass('dark-mode');
			$("#logoOff,#logoDarkmodeOff").removeClass('d-none');
			$("#logoOn,#logoDarkmodeOn").addClass('d-none');
		}
	});


    // let el = document.querySelector(element)
    // let styles = el.getAttribute('style')

    // el.setAttribute('style', styles.replace('width: 100%', ''))
    setTimeout(function () {
        $(".is767").removeClass('d-none');
    },1000)

	// dataTable default
});

function createYoutubeEmbed  (key){
    return '<iframe  src="https://www.youtube.com/embed/' + key + '" frameborder="0" uk-video="automute: true" allowfullscreen uk-responsive></iframe>';
}
function transformYoutubeLinks  (text){
    if (!text) return text;
    const self = this;
    const linkreg = /(?:)<a([^>]+)>(.+?)<\/a>/g;
    const fullreg = /(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)([^& \n<]+)(?:[^ \n<]+)?/g;
    const regex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([^& \n<]+)(?:[^ \n<]+)?/g;
    let resultHtml = text;
    // get all the matches for youtube links using the first regex
    const match = text.match(fullreg);
    if (match && match.length > 0) {
      // get all links and put in placeholders
      const matchlinks = text.match(linkreg);
      if (matchlinks && matchlinks.length > 0) {
        for (var i=0; i < matchlinks.length; i++) {
          resultHtml = resultHtml.replace(matchlinks[i], "#placeholder" + i + "#");
        }
      }
      // now go through the matches one by one
      for (var i=0; i < match.length; i++) {
        // get the key out of the match using the second regex
        let matchParts = match[i].split(regex);
        // replace the full match with the embedded youtube code
        resultHtml = resultHtml.replace(match[i], self.createYoutubeEmbed(matchParts[1]));
      }
      // ok now put our links back where the placeholders were.
      if (matchlinks && matchlinks.length > 0) {
        for (var i=0; i < matchlinks.length; i++) {
          resultHtml = resultHtml.replace("#placeholder" + i + "#", matchlinks[i]);
        }
      }
    }
    return resultHtml;
};

var colors = new Array(
    [62,35,255],
    [60,255,60],
    [255,35,98],
    [45,175,230],
    [255,0,255],
    [255,128,0]);

  var step = 0;
  //color table indices for:
  // current color left
  // next color left
  // current color right
  // next color right
  var colorIndices = [0,1,2,3];

  //transition speed
  var gradientSpeed = 0.002;

  function updateGradient()
  {

    if ( $===undefined ) return;

  var c0_0 = colors[colorIndices[0]];
  var c0_1 = colors[colorIndices[1]];
  var c1_0 = colors[colorIndices[2]];
  var c1_1 = colors[colorIndices[3]];

  var istep = 1 - step;
  var r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
  var g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
  var b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
  var color1 = "rgb("+r1+","+g1+","+b1+")";

  var r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
  var g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
  var b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
  var color2 = "rgb("+r2+","+g2+","+b2+")";

   $('.bg-color').css({
    background: "-webkit-gradient(linear, left top, right top, from("+color1+"), to("+color2+"))"}).css({
    background: "-moz-linear-gradient(left, "+color1+" 0%, "+color2+" 100%)"});


    $('.color').css({color: color1})
    $('.border-color').css({color: '4px solid '+color1+';'})

    step += gradientSpeed;
    if ( step >= 1 )
    {
      step %= 1;
      colorIndices[0] = colorIndices[1];
      colorIndices[2] = colorIndices[3];

      //pick two new target color indices
      //do not pick the same as the current one
      colorIndices[1] = ( colorIndices[1] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
      colorIndices[3] = ( colorIndices[3] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;

    }
  }
  setInterval(updateGradient,5);

