@extends('layouts.admin')
@section('admin')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-info card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-list"></i>
                 Danh sách danh mục cha
              </h3>
            </div>
            <div class="card-body">
                <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" id="inputSearch" name="inputSearch"  placeholder="Tìm kiếm .... " class="form-control">
                                    <span class="input-group-append">
                                      <button type="button" id="buttonSearch" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                                    </span>
                                  </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button id="buttonShowModalAction"  class="btn btn-warning btn-block ">Thêm mới</button>
                            </div>

                        </div>


                  </div>
            </div>
            <!-- /.card -->
          </div>
          <div class="card card-info card-outline">

            <div class="card-body">
                <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <table id="runDatatable" class="table hover table-hover table-striped w-100">
                                </table>
                            </div>
                        </div>

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
@include('admin.pages.category.modal.parentAction')
@endsection
@section('runJS')
@parent
<script src="{{asset('admin/category/parent.js')}}?v={{ time() }}"></script>
<script>
   var parent = new parent();
    parent.data={
        route:{
            getDatatable:"{{route('admin.category.parent.datatable')}}",
            add:"{{route('admin.category.parent.add')}}",
            edit:"{{route('admin.category.parent.edit')}}",
            delete:"{{route('admin.category.parent.delete')}}",
        }
    },
    parent.init();
</script>
@endsection
