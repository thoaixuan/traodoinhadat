<div class="modalSearch"> <a class="btn-modal-close"><i class="icon-close"> </i></a>
	<div class="inner">
		<div class="heading">Tìm kiếm bất động sản</div>
		<div class="col-12 fhs__title">
			<div class="list-group dataListingType" id="list-tab-2" role="tablist"> <a class="list-group-item list-group-item-action dataType active" id="list-buy-mb-list" data-toggle="list" href="#list-buy-mb" role="tab" aria-controls="buy" data-type="1">Mua</a>
				<a class="list-group-item list-group-item-action dataType" id="list-rent-mb-list" data-toggle="list" href="#list-rent-mb" role="tab" aria-controls="rent" data-type="2">Thuê</a>
				<a class="list-group-item list-group-item-action dataType" id="list-project-mb-list" data-toggle="list" href="#list-project-mb" role="tab" aria-controls="project" data-type="3">DựÁn</a>
			</div>
		</div>
		<div class="col-12 modaleSearch-content">
			<div class="tab-content" id="nav-tabContent-2">
				<div class="tab-pane fade content-filter" id="list-buy-mb" role="tabpanel" aria-labelledby="list-buy-mb-list">
					<div class="search-muaban group-range-price">
						<form id="form-search-buy">
							<div class="row container pt-15 pb-15">
								<div class="col-12">
									<div class="f-s-1">
										<div class="search-keyword-container" style="position: relative;">
											<input type="text" id="search_text" name="search_text" autocomplete="off" placeholder="Nhập địa điểm tìm kiếm" class="input search-text" style="height: 50px;">
										</div>
									</div>
								</div>
								<div class="col-12 col-listing-type">
									<div class="f-s-2 input-group">
										<div class="input-group-addon">Loại hình BĐS</div>
										<select class="select style-1 property_type jqmsLoaded ms-list-1" id="select-property" name="property_type">
											<option selected="" value="11">Nhà riêng</option>
											<option value="13">Đất nền</option>
											<option value="8">Chung cư/Căn hộ</option>
											<option value="14">Đất nền dự án</option>
										</select>
									</div>
								</div>
								<div class="col-6 col-city">
									<select class="select" id="select-city" name="select_city">
										<option value="1">Tp Hồ Chí Minh</option>
									</select>
								</div>
								<div class="col-6 col-district">
									<select id="select-district" name="select_district" class="select jqmsLoaded ms-list-2">
										<option value="1">Quận 1</option>
										<option value="2">Quận 2</option>
										<option value="3">Quận 3</option>
										<option value="4">Quận 4</option>
										<option value="5">Quận 5</option>
										<option value="6">Quận 6</option>
										<option value="7">Quận 7</option>
										<option value="8">Quận 8</option>
										<option value="9">Quận 9</option>
										<option value="10">Quận 10</option>
										<option value="11">Quận 11</option>
										<option value="12">Quận 12</option>
										<option value="13">Quận Bình Tân</option>
										<option value="14">Quận Bình Thạnh</option>
										<option value="15">Quận Gò Vấp</option>
										<option value="16">Quận Phú Nhuận</option>
										<option value="17">Quận Tân Bình</option>
										<option value="18">Quận Tân Phú</option>
										<option value="19">Quận Thủ Đức</option>
										<option value="20">Huyện Củ Chi</option>
										<option value="21">Huyện Hóc Môn</option>
										<option value="22">Huyện Bình Chánh</option>
										<option value="23">Huyện Nhà Bè</option>
										<option value="24">Huyện Cần Giờ</option>
									</select>
								</div>
								<div class="col-6 col-ward">
									<select class="select jqmsLoaded ms-list-3" id="select-ward" name="select_ward">
										<option value="8">Phường 1</option>
										<option value="14">Phường 2</option>
									</select>
								</div>
								<div class="col-6 col-year-build">
									<select class="select" id="select-year" name="select_year">
										<option value="" disabled="" selected="" hidden="">Năm xây dựng</option>
										<option value="2011">2011</option>
										<option value="2012">2012</option>
										<option value="2013">2013</option>
										<option value="2014">2014</option>
										<option value="2015">2015</option>
										<option value="2016">2016</option>
										<option value="2017">2017</option>
										<option value="2018">2018</option>
										<option value="2019">2019</option>
										<option value="2020">2020</option>
										<option value="2021">2021</option>
									</select>
								</div>
								<div class="col-6 col-size">
									<select id="select-size" class="select" name="size">
										<option value="0" data-min-size="0" data-max-size="0">Diện tích</option>
										<option value="0" data-min-size="0" data-max-size="30">Dưới 30 m2</option>
										<option value="31" data-min-size="31" data-max-size="40">31 m2 - 40 m2</option>
										<option value="41" data-min-size="41" data-max-size="50">41 m2 - 50 m2</option>
										<option value="51" data-min-size="51" data-max-size="60">51 m2 - 60 m2</option>
										<option value="61" data-min-size="61" data-max-size="70">61 m2 - 70 m2</option>
										<option value="71" data-min-size="71" data-max-size="80">71 m2 - 80 m2</option>
										<option value="81" data-min-size="81" data-max-size="90">81 m2 - 90 m2</option>
										<option value="91" data-min-size="91" data-max-size="100">91 m2 - 100 m2</option>
										<option value="100" data-min-size="100" data-max-size="100000">Trên 100 m2</option>
									</select>
								</div>
								<div class="col-6 col-position-search">
									<select class="select" id="is_front_alley" name="is_front_alley">
										<option data-value="" class="is_front_alley" value="" selected="">Vị trí</option>
										<option data-value="0" class="is_front_alley" id="is_road_front" value="0">Mặt tiền</option>
										<option data-value="1" class="is_front_alley" id="is_alley" value="1">Hẻm</option>
									</select>
								</div>
								<div class="col-6 select-direction">
									<select class="select" id="select-direction" name="direction[]">
										<option value="" selected="">Hướng</option>
										<option id="label_direction_1" value="1">Đông</option>
										<option id="label_direction_2" value="2">Tây</option>
										<option id="label_direction_3" value="3">Nam</option>
										<option id="label_direction_4" value="4">Bắc</option>
										<option id="label_direction_5" value="5">Đông Bắc</option>
										<option id="label_direction_6" value="6">Tây Bắc</option>
										<option id="label_direction_7" value="7">Đông Nam</option>
										<option id="label_direction_8" value="8">Tây Nam</option>
									</select>
								</div>
								<div class="col-12 m-0 col-rented-ccch">
									<div class="title">Tình trạng</div>
									<div class="row grid-space-0">
										<div class="col-4">
											<label class="checkbox">
												<input type="checkbox" id="status_listing_5" name="status_listing[]" value="5"> <span></span>Đặc biệt</label>
										</div>
										<div class="col-4">
											<label class="checkbox">
												<input type="checkbox" id="status_listing_6" name="status_listing[]" value="6"> <span></span>Đã thẩm định</label>
										</div>
										<div class="col-4">
											<label class="checkbox">
												<input type="checkbox" id="status_listing" class="status_listing" name="status_listing[]" value="1"> <span></span>
												<div class="status-rented-saled">Đã bán</div>
											</label>
										</div>
									</div>
								</div>
								<div class="col-12 m-0 col-3d-touring">
									<div class="title">Loại nội dung</div>
									<div class="row grid-space-0">
										<div class="col-4">
											<label class="checkbox">
												<input type="checkbox" id="virtual-touring" name="virtual_touring" value="1"> <span></span>3D Tour</label>
										</div>
									</div>
								</div>
								<div class="col-6 col-sm-4 select-floor-container">
									<div class="title">Số tầng:</div>
									<div class="qualitys input"> <a class="minus"><i class="icon-minus-2"></i></a>
										<input id="floor-value" readonly="" type="text" name="floor-value" maxvalue="6" value="0"> <a class="plus"><i class="icon-plus-2"></i></a>
									</div>
								</div>
								<div class="col-6 col-sm-4 select-bed-container">
									<div class="title">Số phòng ngủ:</div>
									<div class="qualitys input"> <a class="minus"><i class="icon-minus-2"></i></a>
										<input id="bed-value" readonly="" type="text" name="bed-value" maxvalue="6" value="0"> <a class="plus"><i class="icon-plus-2"></i></a>
									</div>
								</div>
								<div class="col-6 col-sm-4 select-bath-container">
									<div class="title">Số phòng tắm:</div>
									<div class="qualitys input"> <a class="minus"><i class="icon-minus-2"></i></a>
										<input id="bath-value" readonly="" type="text" name="bath-value" maxvalue="6" value="0"> <a class="plus"><i class="icon-plus-2"></i></a>
									</div>
								</div>
							</div>
						</form>
						<div class="container pb-15">
							<div class="f-s-2 input-group mb-10">
								<input id="name-search" required="required" type="text" class="input" placeholder="Tên bộ tìm kiếm" value="">
								<div class="input-group-addon p-0"> <a id="save-apply-search" class="btn btn-5">Lưu</a>
								</div>
							</div>
							<button id="apply-search" class="btn btn-3">Tìm kiếm</button>
						</div>
					</div>
				</div>
				<div class="tab-pane fade content-filter" id="list-rent-mb" role="tabpanel" aria-labelledby="list-rent-mb-list">
					<div class="search-muaban group-range-price">
						<form id="form-search-buy">
							<div class="row container pt-15 pb-15">
								<div class="col-12">
									<div class="f-s-1">
										<div class="search-keyword-container" style="position: relative;">
											<input type="text" id="search_text" name="search_text" autocomplete="off" placeholder="Nhập địa điểm tìm kiếm" class="input search-text" style="height: 50px;">
										</div>
									</div>
								</div>
								<div class="col-12 col-listing-type">
									<div class="f-s-2 input-group">
										<div class="input-group-addon">Loại hình BĐS</div>
										<select class="select style-1 property_type jqmsLoaded ms-list-1" id="select-property" name="property_type">
											<option selected="" value="11">Nhà riêng</option>
											<option value="13">Đất nền</option>
											<option value="8">Chung cư/Căn hộ</option>
											<option value="14">Đất nền dự án</option>
										</select>
									</div>
								</div>
								<div class="col-6 col-city">
									<select class="select" id="select-city" name="select_city">
										<option value="1">Tp Hồ Chí Minh</option>
									</select>
								</div>
								<div class="col-6 col-district">
									<select id="select-district" name="select_district" class="select jqmsLoaded ms-list-2">
										<option value="1">Quận 1</option>
										<option value="2">Quận 2</option>
										<option value="3">Quận 3</option>
										<option value="4">Quận 4</option>
										<option value="5">Quận 5</option>
										<option value="6">Quận 6</option>
										<option value="7">Quận 7</option>
										<option value="8">Quận 8</option>
										<option value="9">Quận 9</option>
										<option value="10">Quận 10</option>
										<option value="11">Quận 11</option>
										<option value="12">Quận 12</option>
										<option value="13">Quận Bình Tân</option>
										<option value="14">Quận Bình Thạnh</option>
										<option value="15">Quận Gò Vấp</option>
										<option value="16">Quận Phú Nhuận</option>
										<option value="17">Quận Tân Bình</option>
										<option value="18">Quận Tân Phú</option>
										<option value="19">Quận Thủ Đức</option>
										<option value="20">Huyện Củ Chi</option>
										<option value="21">Huyện Hóc Môn</option>
										<option value="22">Huyện Bình Chánh</option>
										<option value="23">Huyện Nhà Bè</option>
										<option value="24">Huyện Cần Giờ</option>
									</select>
								</div>
								<div class="col-6 col-ward">
									<select class="select jqmsLoaded ms-list-3" id="select-ward" name="select_ward">
										<option value="8">Phường 1</option>
										<option value="14">Phường 2</option>
									</select>
								</div>
								<div class="col-6 col-year-build">
									<select class="select" id="select-year" name="select_year">
										<option value="" disabled="" selected="" hidden="">Năm xây dựng</option>
										<option value="2011">2011</option>
										<option value="2012">2012</option>
										<option value="2013">2013</option>
										<option value="2014">2014</option>
										<option value="2015">2015</option>
										<option value="2016">2016</option>
										<option value="2017">2017</option>
										<option value="2018">2018</option>
										<option value="2019">2019</option>
										<option value="2020">2020</option>
										<option value="2021">2021</option>
									</select>
								</div>
								<div class="col-6 col-size">
									<select id="select-size" class="select" name="size">
										<option value="0" data-min-size="0" data-max-size="0">Diện tích</option>
										<option value="0" data-min-size="0" data-max-size="30">Dưới 30 m2</option>
										<option value="31" data-min-size="31" data-max-size="40">31 m2 - 40 m2</option>
										<option value="41" data-min-size="41" data-max-size="50">41 m2 - 50 m2</option>
										<option value="51" data-min-size="51" data-max-size="60">51 m2 - 60 m2</option>
										<option value="61" data-min-size="61" data-max-size="70">61 m2 - 70 m2</option>
										<option value="71" data-min-size="71" data-max-size="80">71 m2 - 80 m2</option>
										<option value="81" data-min-size="81" data-max-size="90">81 m2 - 90 m2</option>
										<option value="91" data-min-size="91" data-max-size="100">91 m2 - 100 m2</option>
										<option value="100" data-min-size="100" data-max-size="100000">Trên 100 m2</option>
									</select>
								</div>
								<div class="col-6 col-position-search">
									<select class="select" id="is_front_alley" name="is_front_alley">
										<option data-value="" class="is_front_alley" value="" selected="">Vị trí</option>
										<option data-value="0" class="is_front_alley" id="is_road_front" value="0">Mặt tiền</option>
										<option data-value="1" class="is_front_alley" id="is_alley" value="1">Hẻm</option>
									</select>
								</div>
								<div class="col-6 select-direction">
									<select class="select" id="select-direction" name="direction[]">
										<option value="" selected="">Hướng</option>
										<option id="label_direction_1" value="1">Đông</option>
										<option id="label_direction_2" value="2">Tây</option>
										<option id="label_direction_3" value="3">Nam</option>
										<option id="label_direction_4" value="4">Bắc</option>
										<option id="label_direction_5" value="5">Đông Bắc</option>
										<option id="label_direction_6" value="6">Tây Bắc</option>
										<option id="label_direction_7" value="7">Đông Nam</option>
										<option id="label_direction_8" value="8">Tây Nam</option>
									</select>
								</div>
								<div class="col-12 m-0 col-rented-ccch">
									<div class="title">Tình trạng</div>
									<div class="row grid-space-0">
										<div class="col-4">
											<label class="checkbox">
												<input type="checkbox" id="status_listing_5" name="status_listing[]" value="5"> <span></span>Đặc biệt</label>
										</div>
										<div class="col-4">
											<label class="checkbox">
												<input type="checkbox" id="status_listing_6" name="status_listing[]" value="6"> <span></span>Đã thẩm định</label>
										</div>
										<div class="col-4">
											<label class="checkbox">
												<input type="checkbox" id="status_listing" class="status_listing" name="status_listing[]" value="1"> <span></span>
												<div class="status-rented-saled">Đã bán</div>
											</label>
										</div>
									</div>
								</div>
								<div class="col-12 m-0 col-3d-touring">
									<div class="title">Loại nội dung</div>
									<div class="row grid-space-0">
										<div class="col-4">
											<label class="checkbox">
												<input type="checkbox" id="virtual-touring" name="virtual_touring" value="1"> <span></span>3D Tour</label>
										</div>
									</div>
								</div>
								<div class="col-6 col-sm-4 select-floor-container">
									<div class="title">Số tầng:</div>
									<div class="qualitys input"> <a class="minus"><i class="icon-minus-2"></i></a>
										<input id="floor-value" readonly="" type="text" name="floor-value" maxvalue="6" value="0"> <a class="plus"><i class="icon-plus-2"></i></a>
									</div>
								</div>
								<div class="col-6 col-sm-4 select-bed-container">
									<div class="title">Số phòng ngủ:</div>
									<div class="qualitys input"> <a class="minus"><i class="icon-minus-2"></i></a>
										<input id="bed-value" readonly="" type="text" name="bed-value" maxvalue="6" value="0"> <a class="plus"><i class="icon-plus-2"></i></a>
									</div>
								</div>
								<div class="col-6 col-sm-4 select-bath-container">
									<div class="title">Số phòng tắm:</div>
									<div class="qualitys input"> <a class="minus"><i class="icon-minus-2"></i></a>
										<input id="bath-value" readonly="" type="text" name="bath-value" maxvalue="6" value="0"> <a class="plus"><i class="icon-plus-2"></i></a>
									</div>
								</div>
							</div>
						</form>
						<div class="container pb-15">
							<div class="f-s-2 input-group mb-10">
								<input id="name-search" required="required" type="text" class="input" placeholder="Tên bộ tìm kiếm" value="">
								<div class="input-group-addon p-0"> <a id="save-apply-search" class="btn btn-5">Lưu</a>
								</div>
							</div>
							<button id="apply-search" class="btn btn-3">Tìm kiếm</button>
						</div>
					</div>
				</div>
				<div class="tab-pane fade content-filter" id="list-project-mb" role="tabpanel" aria-labelledby="list-project-mb-list">
					<div class="search-muaban group-range-price">
						<form id="form-search-buy">
							<div class="row container pt-15 pb-15">
								<div class="col-12">
									<div class="f-s-1">
										<div class="search-keyword-container" style="position: relative;">
											<input type="text" id="search_text" name="search_text" autocomplete="off" placeholder="Nhập địa điểm tìm kiếm" class="input search-text" style="height: 50px;">
										</div>
									</div>
								</div>
								<div class="col-12 col-listing-type">
									<div class="f-s-2 input-group">
										<div class="input-group-addon">Loại hình BĐS</div>
										<select class="select style-1 property_type ms-list-1 jqmsLoaded" id="select-property" name="property_type">
											<option value="1">Chung cư/Căn hộ</option>
											<option value="2">Nhà riêng</option>
										</select>
									</div>
								</div>
								<div class="col-6 col-city">
									<select class="select" id="select-city" name="select_city">
										<option value="1">Tp Hồ Chí Minh</option>
									</select>
								</div>
								<div class="col-6 col-district">
									<select id="select-district" name="select_district" class="select jqmsLoaded ms-list-2">
										<option value="1">Quận 1</option>
										<option value="2">Quận 2</option>
										<option value="3">Quận 3</option>
										<option value="4">Quận 4</option>
										<option value="5">Quận 5</option>
										<option value="6">Quận 6</option>
										<option value="7">Quận 7</option>
										<option value="8">Quận 8</option>
										<option value="9">Quận 9</option>
										<option value="10">Quận 10</option>
										<option value="11">Quận 11</option>
										<option value="12">Quận 12</option>
										<option value="13">Quận Bình Tân</option>
										<option value="14">Quận Bình Thạnh</option>
										<option value="15">Quận Gò Vấp</option>
										<option value="16">Quận Phú Nhuận</option>
										<option value="17">Quận Tân Bình</option>
										<option value="18">Quận Tân Phú</option>
										<option value="19">Quận Thủ Đức</option>
										<option value="20">Huyện Củ Chi</option>
										<option value="21">Huyện Hóc Môn</option>
										<option value="22">Huyện Bình Chánh</option>
										<option value="23">Huyện Nhà Bè</option>
										<option value="24">Huyện Cần Giờ</option>
									</select>
								</div>
								<div class="col-6 col-ward">
									<select class="select jqmsLoaded ms-list-3" id="select-ward" name="select_ward">
										<option value="8">Phường 1</option>
										<option value="14">Phường 2</option>
									</select>
								</div>
								<div class="col-6 col-year-build">
									<select class="select" id="select-year" name="select_year">
										<option value="" disabled="" selected="" hidden="">Năm xây dựng</option>
										<option value="2011">2011</option>
										<option value="2012">2012</option>
										<option value="2013">2013</option>
										<option value="2014">2014</option>
										<option value="2015">2015</option>
										<option value="2016">2016</option>
										<option value="2017">2017</option>
										<option value="2018">2018</option>
										<option value="2019">2019</option>
										<option value="2020">2020</option>
										<option value="2021">2021</option>
									</select>
								</div>
								<div class="col-6 col-size">
									<select id="select-size" class="select" name="size">
										<option value="0" data-min-size="0" data-max-size="0">Diện tích</option>
										<option value="0" data-min-size="0" data-max-size="30">Dưới 30 m2</option>
										<option value="31" data-min-size="31" data-max-size="40">31 m2 - 40 m2</option>
										<option value="41" data-min-size="41" data-max-size="50">41 m2 - 50 m2</option>
										<option value="51" data-min-size="51" data-max-size="60">51 m2 - 60 m2</option>
										<option value="61" data-min-size="61" data-max-size="70">61 m2 - 70 m2</option>
										<option value="71" data-min-size="71" data-max-size="80">71 m2 - 80 m2</option>
										<option value="81" data-min-size="81" data-max-size="90">81 m2 - 90 m2</option>
										<option value="91" data-min-size="91" data-max-size="100">91 m2 - 100 m2</option>
										<option value="100" data-min-size="100" data-max-size="100000">Trên 100 m2</option>
									</select>
								</div>
								<div class="col-6 col-position-search">
									<select class="select" id="is_front_alley" name="is_front_alley">
										<option data-value="" class="is_front_alley" value="" selected="">Vị trí</option>
										<option data-value="0" class="is_front_alley" id="is_road_front" value="0">Mặt tiền</option>
										<option data-value="1" class="is_front_alley" id="is_alley" value="1">Hẻm</option>
									</select>
								</div>
								<div class="col-6 select-direction">
									<select class="select" id="select-direction" name="direction[]">
										<option value="" selected="">Hướng</option>
										<option id="label_direction_1" value="1">Đông</option>
										<option id="label_direction_2" value="2">Tây</option>
										<option id="label_direction_3" value="3">Nam</option>
										<option id="label_direction_4" value="4">Bắc</option>
										<option id="label_direction_5" value="5">Đông Bắc</option>
										<option id="label_direction_6" value="6">Tây Bắc</option>
										<option id="label_direction_7" value="7">Đông Nam</option>
										<option id="label_direction_8" value="8">Tây Nam</option>
									</select>
								</div>
								<div class="col-12 m-0 col-rented-ccch">
									<div class="title">Tình trạng</div>
									<div class="row grid-space-0">
										<div class="col-4">
											<label class="checkbox">
												<input type="checkbox" id="status_listing_5" name="status_listing[]" value="5"> <span></span>Đặc biệt</label>
										</div>
										<div class="col-4">
											<label class="checkbox">
												<input type="checkbox" id="status_listing_6" name="status_listing[]" value="6"> <span></span>Đã thẩm định</label>
										</div>
										<div class="col-4">
											<label class="checkbox">
												<input type="checkbox" id="status_listing" class="status_listing" name="status_listing[]" value="1"> <span></span>
												<div class="status-rented-saled">Đã bán</div>
											</label>
										</div>
									</div>
								</div>
								<div class="col-12 m-0 col-3d-touring">
									<div class="title">Loại nội dung</div>
									<div class="row grid-space-0">
										<div class="col-4">
											<label class="checkbox">
												<input type="checkbox" id="virtual-touring" name="virtual_touring" value="1"> <span></span>3D Tour</label>
										</div>
									</div>
								</div>
								<div class="col-6 col-sm-4 select-floor-container">
									<div class="title">Số tầng:</div>
									<div class="qualitys input"> <a class="minus"><i class="icon-minus-2"></i></a>
										<input id="floor-value" readonly="" type="text" name="floor-value" maxvalue="6" value="0"> <a class="plus"><i class="icon-plus-2"></i></a>
									</div>
								</div>
								<div class="col-6 col-sm-4 select-bed-container">
									<div class="title">Số phòng ngủ:</div>
									<div class="qualitys input"> <a class="minus"><i class="icon-minus-2"></i></a>
										<input id="bed-value" readonly="" type="text" name="bed-value" maxvalue="6" value="0"> <a class="plus"><i class="icon-plus-2"></i></a>
									</div>
								</div>
								<div class="col-6 col-sm-4 select-bath-container">
									<div class="title">Số phòng tắm:</div>
									<div class="qualitys input"> <a class="minus"><i class="icon-minus-2"></i></a>
										<input id="bath-value" readonly="" type="text" name="bath-value" maxvalue="6" value="0"> <a class="plus"><i class="icon-plus-2"></i></a>
									</div>
								</div>
							</div>
						</form>
						<div class="container pb-15">
							<div class="f-s-2 input-group mb-10">
								<input id="name-search" required="required" type="text" class="input" placeholder="Tên bộ tìm kiếm" value="">
								<div class="input-group-addon p-0"> <a id="save-apply-search" class="btn btn-5">Lưu</a>
								</div>
							</div>
							<button id="apply-search" class="btn btn-3">Tìm kiếm</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Search Mobile -->
</div>
