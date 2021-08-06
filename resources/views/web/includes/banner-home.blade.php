<section class="banner-home">
	<!-- BANNER -->
	<div class="banner-slick">
        @foreach (getSilderHome() as $item)
        <div class="banner-slick__img">
			<img src="{{ $item->image }}" alt="{{ $item->name }}">
		</div>
        @endforeach
	</div>
	<!-- BANNER -->
	<!-- Search banner -->
	<div class="container banner-home__search">
		<div class="filter-house filter-home">
			<div class="type-listing-home">
				<div class="row justify-content-md-center">
					<div class="col-12 fhs__title">
						<div class="list-group" id="list-tab" role="tablist">
                            <a class="item list-group-item list-group-item-action active" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile" data-value="cate_buy">Mua</a>
							<a class="item list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab"  aria-controls="messages" data-value='cate_lease'>Thuê</a>
							<a class="item list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab"  aria-controls="settings" data-value='cate_project'>Dự Án</a>
						</div>
					</div>
					<div class="col-10"> <span class="btn-advance-search">Tìm kiếm nâng cao &nbsp; <i class="icon-arrow-2 ib"></i></span>
						<div class="tab-content" id="nav-tabContent">
							@include('web.includes.search.main')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Search banner -->
</section>
