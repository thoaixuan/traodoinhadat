<section class="d-relative new-wrapper">
    <div class="menu-new">
      <div class="container">
        <div class="mn__list">
          <ul>
              @foreach (getCategoryPost() as $item)
                 <li><a href="{{$item->url}}">{{ $item->cate_name }}</a> </li>
              @endforeach
          </ul>
        </div>
        <div class="mn__button--mb mn__button--js">
          <div class="mn__button--1"></div>
          <div class="mn__button--2"></div>
          <div class="mn__button--3"></div>
        </div>
        <button class="secShowFilter btn-search1 btn__search--js"><i class="icon-search-2"></i> </button>
      </div>
      <div class="mn__form filter-house-subpage filter-house-subpage-js" id="searchSticky">
        <div class="container">
          <form class="c-form1" action="{{ route('web.news.search') }}">
            <div class="input-placeholder c-form1__info">
              <input type="text" required="" class="required" value="" name="q" placeholder="Nhập từ khóa cần tìm…">
            </div>
            <button type="submit" class="c-btn1">
              <span>Tìm kiếm</span> <i class="icon icon-search"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
