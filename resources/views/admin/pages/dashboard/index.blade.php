@extends('layouts.admin')
@section('admin')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-list"></i>
                 Bảng điều khiển
              </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h3 class="count">{{ countCategorys() }}</h3>

                          <p>Danh mục</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('admin.category.parent.view') }}" class="small-box-footer"> Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 class="count">{{ countPosts() }}</h3>

                          <p>Bài viết</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('admin.news.view') }}" class="small-box-footer"> Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3 class="count">{{ countUserMembers() }}</h3>

                          <p>Thành viên</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('admin.user.view') }}?type=userCreate" class="small-box-footer"> Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h3 class="count">{{ countUserAdmin() }}</h3>

                          <p>Quản trị viên</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('admin.user.view') }}?type=userAdminCreate" class="small-box-footer"> Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
            </div>
            <!-- /.card -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-6">
                      <label>Hiển thị liên hệ trạng thái chưa xử lý</label>
                    </div>
                  </div>
            </div>
          </div>


        </div>
        <div class="col-md-12">
            <div class="card card-warning card-outline">
              <div class="card-body">
                  <div class="row">
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="">
                        Hiển thị bài viết nhiều lượt xem nhất, bài viết nổi bật
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                          <div class="inner">
                            <h3 class="count">{{ countRealestateSend() }}</h3>

                            <p>Tin chưa duyệt</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                          </div>
                          <a href="{{route('admin.realestate.received') }}" class="small-box-footer"> Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="text-center">
                          <button class="btn btn-default">Backup data</button>
                        </div>
                      </div>
                      <!-- ./col -->
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                          <div class="inner">
                            <h3 class="count">0</h3>

                            <p>Liên hệ BĐS</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-person-add"></i>
                          </div>
                          <a href="{{ route('admin.user.view') }}?type=userCreate" class="small-box-footer"> Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <!-- ./col -->
                    </div>
              </div>
              <!-- /.card -->
            </div>


          </div>
        <!-- /.col -->
      </div>
      <!-- ./row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection
