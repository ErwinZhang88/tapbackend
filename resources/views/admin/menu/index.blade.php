@extends('layouts.admin')

@section('style')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>List Menu</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Menu</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
        <div class="card-header">
        <h3 class="card-title">List Menu</h3>

        <!-- <div class="card-tools">
          <a href="{{ route('admin.menu.create') }}" class="btn btn-block bg-gradient-primary">Add Menu</a>
        </div> -->
        </div>
        <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Name (ID)</th>
                    <th>Name (EN)</th>
                    <th>SubMenu</th>
                    <th>Banner</th>
                    <th>Icon</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($menu as $row)
                  <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->nameEn }}</td>
                    <td>{{ $row->submenu }}</td>
                    <td><img src="{{ $row->banner_url }}" style="width:20%;"></td>
                    <td><img src="{{ $row->icon_url }}" style="width:20px;height:10px;"></td>
                    <td>
                      <a href="{{ route('admin.menu.edit',[$row->id]) }}" class="btn btn-block bg-gradient-success">Edit</a>
                      <a href="{{ route('admin.menu.edit',[$row->id]) }}" class="btn btn-block bg-gradient-danger">Delete</a>
                    </td>
                  </tr>
                  @endforeach
                  </tfoot>
                </table>
              </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('script')
<!-- DataTables -->
<script src="{{ asset('admins/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admins/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>
@endsection