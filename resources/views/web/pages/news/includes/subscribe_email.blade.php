<div class="mb50 efch-2 ef-img-b">
    <section class="c-form-mail">
      <p class="label1">
        <i class="iconmoon iconmoon-mail4"></i>
      </p>
      <h2 class="c-title1">Nhập email để nhận những tin mới nhất từ thị trường</h2>
      <form id="formSubscribeNews" class="c-form1" action="{{ route('web.subscribe.add') }}">
          <div id="alertJSSubscribeNews"></div>
        <div class="input-placeholder c-form1__info">
          <input type="email" required="" class="required" placeholder="Email ... " id="subscribe_email" name="email">
        </div>
        <button type="submit" id="buttonSubscribeNews" class="c-btn1">
          <i class="icon icon-point"></i>
          ĐĂNG KÝ
        </button>
      </form>
      <p class="note1">Đừng lo, chúng tôi ghét spam</p>
    </section>
  </div>
