jQuery(document).ready(function () {

   jQuery(".qualitys").each(function() {
      var t = jQuery(this).children(".qualitys input")
        , e = jQuery(this).children(".qualitys .plus")
        , i = jQuery(this).children(".qualitys .minus")
        , n = parseFloat(t.attr("maxvalue"));
      function o(e) {
          t.val(e)
      }
      t.on("change", function() {
          var e = t.val();
          e > n && (e = n),
          e < 1 && (e = ""),
          o(e)
      }),
      jQuery(e).on("click", function() {
          var e = t.val();
          "" == e ? e = 1 : e++,
          e > n && (e = n),
          o(e)
      }),
      jQuery(i).on("click", function() {
          var e = t.val();
          e > 1 ? e-- : e = "",
          o(e)
      })
  });

   jQuery('.filter-home .btn-advance-search').on('click', function(){
      jQuery('.filter-home .advance-search').toggleClass('show');
   });

   if (jQuery('#searchSticky').hasClass('filter-house-subpage-js')) {
      jQuery('body').addClass('search-sticky');
   }

   var $animation_elements = jQuery('.ef-lazy');
   var distance = jQuery('#header').offset().top;
   var lastScroll = 0;

   //Fixed header
   jQuery(window).on('scroll', function () {
      let currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
      if (jQuery(window).scrollTop() >= distance) {
         jQuery('body').addClass("sticky-body");
         if (currentScroll > 0 && lastScroll <= currentScroll) {
            lastScroll = currentScroll;
            jQuery('#header').addClass("stickyDown");
         } else {
            lastScroll = currentScroll;
            jQuery('#header').removeClass("stickyDown");
         }
      } else {
         jQuery('body').removeClass("sticky-body");
         jQuery('#header').removeClass("stickyDown");
      }
   })

   //Sự kiện thêm animation
   jQuery(window).on('scroll resize', function () {
      var window_height = jQuery(window).height();
      var window_top_position = jQuery(window).scrollTop();
      var window_bottom_position = (window_top_position + window_height);

      jQuery.each($animation_elements, function () {
         var element_height = jQuery(this).outerHeight();
         var element_top_position = jQuery(this).offset().top;
         var element_bottom_position = (element_top_position + element_height);
         //check to see if this current container is within viewport
         if ((element_bottom_position >= window_top_position) &&
            (element_top_position <= window_bottom_position)) {
            jQuery(this).addClass('ef-begin');
            jQuery(this).removeClass('ef-lazy');
         }
      });
   });
   jQuery(window).trigger('scroll');

   jQuery('.product__list--big').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      dots: false,
      fade: true,
      asNavFor: '.product__list--small'
   });
   jQuery('.product__list--small').slick({
      slidesToShow: 5,
      slidesToScroll: 1,
      asNavFor: '.product__list--big',
      arrows: false,
      dots: false,
      focusOnSelect: true
   });
   jQuery('.banner-slick').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      dots: true,
      fade: true,
      autoplay: true,
      autoplaySpeed: 5000,
   });

   jQuery('.bds-noibat-special').slick({
      infinite: false,
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true,
      autoplaySpeed: 5000,
      responsive: [
         {
            breakpoint: 768,
            settings: {
               slidesToShow: 2,
            }
         },
         {
            breakpoint: 480,
            settings: {
               slidesToShow: 1,
            }
         },
      ]
   });

   jQuery('.bds-info__districtId').slick({
      infinite: false,
      slidesToShow: 6,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true,
      autoplaySpeed: 5000,
      responsive: [
         {
            breakpoint: 1200,
            settings: {
               slidesToShow: 6,
            }
         },
         {
            breakpoint: 1024,
            settings: {
               slidesToShow: 4,
            }
         },
         {
            breakpoint: 617,
            settings: {
               slidesToShow: 3,
            }
         },
         {
            breakpoint: 617,
            settings: {
               slidesToShow: 2,
            }
         }
      ]
   });

   jQuery('.bds-noibat-hot__info').slick({
      infinite: false,
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true,
      autoplaySpeed: 5000,
      responsive: [
         {
            breakpoint: 1024,
            settings: {
               slidesToShow: 2,
            }
         },
         {
            breakpoint: 480,
            settings: {
               slidesToShow: 1,
            }
         },
      ]
   });
   jQuery('.bds-buy__info').slick({
      infinite: false,
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true,
      autoplaySpeed: 5000,
      responsive: [
         {
            breakpoint: 1024,
            settings: {
               slidesToShow: 2,
            }
         },
         {
            breakpoint: 480,
            settings: {
               slidesToShow: 1,
            }
         },
      ]
   });
   jQuery('.bds-chothue__info').slick({
      infinite: false,
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true,
      autoplaySpeed: 5000,
      responsive: [
         {
            breakpoint: 1024,
            settings: {
               slidesToShow: 2,
            }
         },
         {
            breakpoint: 480,
            settings: {
               slidesToShow: 1,
            }
         },
      ]
   });
   jQuery('.duan__info--1').slick({
      infinite: false,
      slidesToShow: 2,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true,
      autoplaySpeed: 5000,
      responsive: [
         {
            breakpoint: 768,
            settings: {
               slidesToShow: 1,
            }
         },
      ]
   });
   jQuery('.duan__list').slick({
      infinite: false,
      slidesToShow: 2,
      slidesToScroll: 1,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 5000,
      responsive: [
         {
            breakpoint: 960,
            settings: {
               slidesToShow: 1,
               arrows: true,
            }
         },
      ]
   });
   jQuery('.district-hot__list').slick({
      infinite: false,
      slidesToShow: 2,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true,
      autoplaySpeed: 5000,
      responsive: [
         {
            breakpoint: 480,
            settings: {
               slidesToShow: 1,
            }
         },
      ]
   });
   jQuery('.ns__hot--slick').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      dots: false,
      autoplay: true,
      autoplaySpeed: 5000,
   });
   jQuery('.nsh__slick--right-js').slick({
      infinite: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      dots: false,
      autoplay: true,
      autoplaySpeed: 5000,
      prevArrow: jQuery('.slick-group-button .c-arrow1--left'),
      nextArrow: jQuery('.slick-group-button .c-arrow1--right'),
   });
   jQuery('.housebf-slick').slick({
      infinite: false,
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: true,
      dots: false,
      autoplay: true,
      autoplaySpeed: 5000,
      responsive: [
         {
            breakpoint: 1024,
            settings: {
               slidesToShow: 2,
            }
         },
         {
            breakpoint: 480,
            settings: {
               slidesToShow: 1,
            }
         },
      ]
   });
   jQuery('.icon-slick').slick({
      infinite: false,
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: true,
      dots: false,
      autoplay: true,
      autoplaySpeed: 5000,
      responsive: [
         {
            breakpoint: 1024,
            settings: {
               slidesToShow: 2,
            }
         },
         {
            breakpoint: 590,
            settings: {
               slidesToShow: 1,
            }
         },
      ]
   });
   jQuery('.thitruong-slick').slick({
      infinite: false,
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: true,
      dots: false,
      autoplay: true,
      autoplaySpeed: 5000,
      responsive: [
         {
            breakpoint: 1024,
            settings: {
               slidesToShow: 2,
            }
         },
         {
            breakpoint: 480,
            settings: {
               slidesToShow: 1,
            }
         },
      ]
   });

   //Sự kiện khi nhấn show/hidden password
   jQuery("#popup-login .span-eyes").on('click', function (e) {
      const type = jQuery("#password").attr('type') === 'password' ? 'text' : 'password';
      jQuery("#password").attr('type', type);
      //Thay đổi hình ảnh icon password
      jQuery("#popup-login .span-eyes").toggleClass('fa-eye-slash');
   });

   //Sự kiện khi nhấn nút Quên mật khẩu trong login modal
   jQuery('#popup-login p.forgot-password').on('click', function (e) {
      jQuery('#popup-login').modal('hide');
      jQuery('#popup-forgot-password').modal('show');
   });

   //Sự kiện khi nhấn nút tạo tài khoán trong login modal
   jQuery('#popup-login a.signup-account').on('click', function (e) {
      console.log('1');
      jQuery('#popup-login').modal('hide');
      jQuery('#popup-signup').modal('show');
   });

   //Sự kiện khi nhấn nút tạo tài khoán trong signup modal
   jQuery('#popup-signup a.login-account').on('click', function (e) {
      console.log('1');
      jQuery('#popup-signup').modal('hide');
      jQuery('#popup-login').modal('show');
   });

   //Sự kiện kiểm tra giá trị nhập number
   jQuery('.number-validate').on('keyup', function (e) {
      var t = jQuery(this).val().match(/[\d\.]/g);
      t = t ? t.join("") : "",
         jQuery(this).val(t)
   })

   //Sự kiện khi nhấn show/hidden password trong tạo tài khoản
   jQuery("#popup-signup .span-eyes").on('click', function (e) {
      const type = jQuery("#password_register").attr('type') === 'password' ? 'text' : 'password';
      jQuery("#password_register").attr('type', type);
      //Thay đổi hình ảnh icon password
      jQuery("#popup-signup .span-eyes").toggleClass('fa-eye-slash');
   });

   //Sự kiện khi select Quận
   jQuery("#districtId").on('change', function (e) {
      console.log(jQuery(this).val());
      if (jQuery(this).val() === "") {
         jQuery("#wardId").attr('disabled', 'disabled');
         jQuery("#address").attr('disabled', 'disabled');
      } else {
         jQuery("#wardId").removeAttr('disabled');
         jQuery("#address").removeAttr('disabled');
      }
   })

   jQuery('.type-listing-home .search-type__btn').on('click', function (e) {
      jQuery('.type-listing-home .search-type__btn').removeClass('active');
      jQuery(this).addClass('active');
   })

   //Sự kiện khi nhấn thay đổi quận ở BDS Nổi bật
   jQuery('.bds-noibat-info .bds-info__districtId .info__districtId--item').on('click', function (e) {
      jQuery('.bds-noibat-info .bds-info__districtId .info__districtId--item').removeClass('active');
      jQuery(this).addClass('active');
   })

   //Sự kiện khi nhấn thay đổi quận ở Mua bán BĐS
   jQuery('.bds-buy-info .bds-info__districtId .info__districtId--item').on('click', function (e) {
      jQuery('.bds-buy-info .bds-info__districtId .info__districtId--item').removeClass('active');
      jQuery(this).addClass('active');
   })
   //Sự kiện khi nhấn thay đổi quận ở Mua bán BĐS
   jQuery('.bds-chothue-info .bds-info__districtId .info__districtId--item').on('click', function (e) {
      jQuery('.bds-chothue-info .bds-info__districtId .info__districtId--item').removeClass('active');
      jQuery(this).addClass('active');
   })

   jQuery('#menu-toggle').on('click', function (e) {
      jQuery('.bg-slider-menu').toggleClass('show');
   })
   jQuery('#menu-toggle-mobile').on('click', function (e) {
      jQuery('.bg-slider-menu').toggleClass('show');
   })
   jQuery('#close-nav').on('click', function (e) {
      jQuery('.bg-slider-menu').removeClass('show');
   })
   jQuery('#close-nav-mb').on('click', function (e) {
      jQuery('.bg-slider-menu').removeClass('show');
   })
   jQuery('.bg-slider-menu').on('click', function () {
      jQuery(document).one('click', function closeTooltip(e) {
         if (jQuery('.bg-slider-menu').has(e.target).length === 0 && jQuery('div#menuMoreMB').has(e.target).length === 0) {
            jQuery('.bg-slider-menu').removeClass('show');
         } else if (jQuery('.bg-slider-menu').hasClass('show')) {
            jQuery(document).one('click', closeTooltip);
         }
      });
   })

   //Kiểm tra khi thay đổi kích thước màn hình <= 768px
   // Nếu .bg-slider-menu show
   // Xóa Class show
   jQuery(window).resize(function () {
      if (jQuery(window).width() > 991) {
         if (jQuery('.bg-slider-menu').hasClass('show')) {
            jQuery('.bg-slider-menu').removeClass('show');
         }
      }
   })


   //Sự kiện khi nhấn tìm kiếm
   jQuery('.btn__search--js').on('click', function () {
      jQuery('.btn__search--js').toggleClass('show');
      jQuery('.filter-house-subpage').toggleClass('show');
   })

   //Sự kiện nhấn button menu tin tức trong mobile
   jQuery('.mn__button--js').on('click', function () {
      jQuery('.mn__button--js').toggleClass('open');
      jQuery('.mn__list').toggleClass('open');
   })

   //Sự kiện khi nhấn hiển thị bình luận
   jQuery('.c-btn-comment-js').on('click', function () {
      jQuery('.c-list-comments-js').addClass('show');
      jQuery(this).addClass('hidden');
   })

   //Sự kiện khi nhấn ẩn bình luận
   jQuery('.c-btn-hide-comment-js').on('click', function () {
      jQuery('.c-list-comments-js').removeClass('show');
      jQuery('.c-btn-comment-js').removeClass('hidden');
   })

   jQuery('.tab-title-nc').on('click', function () {
      jQuery('.acordion-search').toggleClass('show');
   })
   //Sự kiến khi nhấn xem dạng list trong danhsachnha
   jQuery('#view-list').on('click', function () {
      jQuery('.item-house').removeClass('col-lg-4 col-6');
      jQuery('.item-house').addClass('col-12');
      jQuery('#view-as-gird').removeClass('list-layout-0 list-item').addClass('list-layout-1 list-layout-1-2');
      jQuery('#view-grid').removeClass('active');
      jQuery('#view-list').addClass('active');
   })
   //Sự kiến khi nhấn xem dạng grid trong danhsachnha
   jQuery('#view-grid').on('click', function () {
      jQuery('.item-house').addClass('col-lg-4 col-6');
      jQuery('.item-house').removeClass('col-12');
      jQuery('#view-as-gird').addClass('list-layout-0 list-item').removeClass('list-layout-1 list-layout-1-2');
      jQuery('#view-grid').addClass('active');
      jQuery('#view-list').removeClass('active');
   })

   //Sự kiện khi nhấn button social plus
   jQuery('.social .social__button a.plus').on('click', function(){
      //Kiểm tra element social có class 'show
      //Nếu có remove class 'show' ở element bl-form-callback, bl-text-contact
      if(jQuery('.social').hasClass('show')){
         jQuery('.social .bl-form-callback').removeClass('show');
         jQuery('.social .bl-text-contact').removeClass('show');
      }
      jQuery('.social').toggleClass('show');

   })

   jQuery('.social .social__chat a.phone').on('click', function(){
      jQuery('.social .bl-form-callback').toggleClass('show');
      jQuery('.social .bl-text-contact').removeClass('show');
   })

   jQuery('.social .social__chat a.chat').on('click', function(){
      jQuery('.social .bl-form-callback').toggleClass('show');
   })

   jQuery('.social .bl-form-callback a.btn-call').on('click', function(){
      jQuery('.social .bl-form-callback').toggleClass('show');
      jQuery('.social .bl-text-contact').toggleClass('show');
   });

   jQuery('.social .bl-text-contact a.a-close').on('click', function(){
      jQuery('.social .bl-text-contact').toggleClass('show');
   })
   jQuery('.social .bl-form-callback a.a-close').on('click', function(){
      jQuery('.social .bl-form-callback').toggleClass('show');
   })

   jQuery('.bh__search--mobile .dataListingType .dataType').on('click', function(){
      jQuery('.dataListingType .dataType').removeClass('active');
      jQuery(this).addClass('active');
   })

   jQuery('.btn-search-mobile').on('click', function(){
      var dataType = jQuery('.bh__search--mobile .dataListingType .dataType.active').data('type');
      jQuery('.modalSearch .dataListingType .dataType.active').removeClass('active');
      jQuery('.modalSearch .dataListingType .dataType').each(function(){
         if(jQuery(this).data('type') === dataType){
            jQuery(this).tab('show');
         }
      });
      jQuery('.modalSearch').addClass('active');
      jQuery(".btn-search input").blur()
   })
   jQuery('.modalSearch .btn-modal-close').on('click', function(){
      var dataType = jQuery('.modalSearch .dataListingType .dataType.active').data('type');
      console.log(dataType);
      jQuery('.bh__search--mobile .dataListingType .dataType.active').removeClass('active');
      jQuery('.bh__search--mobile .dataListingType .dataType').each(function(){
         if(jQuery(this).data('type') === dataType)
            jQuery(this).addClass('active');
      });
      jQuery('.modalSearch').removeClass('active');
   })

   jQuery('.bg-slider-menu ul li span.showsubmenu').on('click', function(){
      jQuery(this).parent('li').toggleClass('showsub');
   })


   //Sự kiện khi nhấn nút Chính chủ trang đăng tin
   jQuery('.dang-tin #isOwner').on('change', function() {
      jQuery(this).is(":checked") ? jQuery("#infos-owner").hide() : jQuery("#infos-owner").show()
   })


   //Sự kiện khi Chọn loại hình giao dịch
//    jQuery(".dang-tin .listingType").on('change',function(){
//       jQuery(".lblTextNumber").text(""),
//       "1" == jQuery(".listingType:checked").val() ?
//       (jQuery(".text-price").html('Giá đề nghị <strong class="color-red">*</strong>'),
//       jQuery(".price-rent").hide(),
//       jQuery(".price-buy").show(),
//       jQuery(".col-deposit").hide(),
//       jQuery(".text-photoGcn").html('<span class="text">Bản vẽ / Sổ </span>(upload tối thiểu 4 hình, kéo thả file hoặc chọn trực tiếp từ máy tính, Dung lượng từ 600kb -> 1Mb kích thước tối thiểu đối với ảnh ngang 1714x968, ảnh đứng 968x1714) <strong class="color-red">*</strong>'),
//       jQuery(".propertyType-rent").hide(),
//       jQuery(".propertyType-buy").show()) :
//       (jQuery(".text-price").html('Giá thuê (tháng) <strong class="color-red">*</strong>'),
//       jQuery(".price-buy").hide(),
//       jQuery(".price-rent").show(),
//       jQuery(".col-deposit").show(),
//       jQuery(".text-photoGcn").html('<span class="text">Bản vẽ / Sổ </span>(kéo thả file hoặc chọn trực tiếp từ máy tính, Dung lượng từ 600kb -> 1Mb kích thước tối thiểu đối với ảnh ngang 1714x968, ảnh đứng 968x1714)'),
//       jQuery(".propertyType-buy").hide(),
//       jQuery(".propertyType-rent").show())
//    })

   jQuery('#upload-file').on('change',function(event){
         var $i = jQuery( '#upload-file' ), input = $i[0];
         if ( input.files && input.files[0] ) {
            file = input.files[0];
            fr = new FileReader();
            fr.onload = function () {
               var s = jQuery(".ajax-file-upload-container").html();
               s += '<div class="ajax-file-upload-statusbar">',
               s += '   <img class="file-upload-preview-listing" src="' + fr.result + '"/>',
               s += '   <div class="ajax-file-upload-red" style=""><i class="far fa-trash-alt"></i></div>',
               s += "</div>",
               jQuery(".ajax-file-upload-container").html(s);
            };
            fr.readAsDataURL( file );
         }
   })

   //Sự kiện khi chọn Chủ nhà trong trang đăng tin
   jQuery('.bl-choose-title #is-owner').on('click', function(){
      jQuery('.bl-choose-title .btn').removeClass('active');
      jQuery(this).addClass('active')
      jQuery('.dang-tin #isAgent').hide();
   })
   //Sự kiện khi chọn Môi giới trong trang đăng tin
   jQuery('.bl-choose-title #is-agent').on('click', function(){
      jQuery('.bl-choose-title .btn').removeClass('active');
      jQuery(this).addClass('active')
      jQuery('.dang-tin #isAgent').show();
   })
})
