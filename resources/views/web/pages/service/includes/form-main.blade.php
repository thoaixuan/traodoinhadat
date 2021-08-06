<div class="row">
    <div class="col-sm-4">
      <div class="form-group">

          <input type="text"
          @if (Auth::check())
          value="{{ user()->full_name }}"
          @endif
          name="full_name"  class="form-control"
            placeholder="Họ và tên" required="required" value="">

      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
          <input type="tel" name="phone"
          @if (Auth::check())
          value="{{ user()->phone }}"
          @endif
          id="phone"
            class="form-control number-validate" placeholder="Số điện thoại" required="required"
            value="">
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">

          <input type="email"
          @if (Auth::check())
          value="{{ user()->email }}"
          @endif
          name="email" id="email" class="form-control"
            placeholder="Email" required="required" value="">

      </div>
    </div>
</div>
