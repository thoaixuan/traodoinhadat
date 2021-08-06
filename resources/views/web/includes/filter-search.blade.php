
<div class="secShowFilter btnShowFilter btn__search--js">Tìm kiếm <i class="icon-search-2"></i>
</div>
<div class="filter-house-subpage filter-house-subpage-js" id="searchSticky">
	<div class="container">
		<div class="row">
			<div class="col-12 fhs__title">
				<div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active mua" id="list-profile-list" data-toggle="list" href="#"  data-value="cate_buy" >Mua</a>
					<a class="list-group-item list-group-item-action thue" id="list-messages-list" data-toggle="list" href="#" data-value="cate_lease"> Thuê</a>
					<a class="list-group-item list-group-item-action du-an" id="list-settings-list" data-toggle="list" href="#" data-value="cate_project" >Dự Án</a>
				</div>
			</div>
			<div class="col-12">
				<div class="tab-content" id="nav-tabContent">
					@include('web.includes.search.main')
				</div>
			</div>
		</div>
	</div>
</div>

