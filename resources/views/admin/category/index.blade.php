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
        <h1>List Category</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Category</li>
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
        <h3 class="card-title">List Category</h3>

        <div class="card-tools">
          <a href="{{ route('admin.category.create') }}" class="btn btn-block bg-gradient-primary">Add Category</a>
        </div>
        </div>
        <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Name (ID)</th>
                    <th>Name (EN)</th>
                    <th>Menu</th>
                    <th>Type</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($category as $row)
                  <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->nameEn }}</td>
                    @if($row->menu)
                    <td>{{ $row->menu->name }} - ({{ $row->menu->parent_id != 0 ? 'SubMenu' : 'Menu' }})</td>
                    @else
                    <td></td>
                    @endif
                    <td>{{ $row->types }}</td>
                    <td>
                      <a href="{{ route('admin.category.edit',[$row->id]) }}" class="btn btn-block bg-gradient-success">Edit</a>
                      <a id="myLink" href="#" data-value="{{ $row->name }}" data-id="{{ $row->id }}" class="btn btn-block bg-gradient-danger delete_item">Delete</a>
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
<meta name="_token" content="{!! csrf_token() !!}" />
@endsection

@section('script')
<!-- DataTables -->
<script src="{{ asset('admins/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admins/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
  $(document).on('click', '.delete_item', function() {
      var dataValue = $(this).attr('data-value');
      var dataId = $(this).attr('data-id');
      var url = '{{ route("admin.category.destroy", ":slug") }}';
      url = url.replace(':slug', dataId);
      console.log(dataValue);
      let message = "You won't be delete "+dataValue+" ?";
      let icon = 'error';
      let hide = 'Yes, delete it!'
      DeleteItem(message,url,hide,icon);
  });

  function DeleteItem(message,url,hide,icon){
    Swal.fire({
        title: 'Are you sure?',
        text: message,
        icon: icon,
        reverseButtons: true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: hide
      }).then((result) => {
        if (result.value) {

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
          })
          $.ajax({
              type: "DELETE",
              url: url,
              success: function(data) {
                  console.log(data);
                  if(data.success){
                    Swal.fire({
                      title: 'Done',
                      text: "You proccess already done!",
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'OK!'
                    }).then((result) => {
                      if (result.value) {
                        location.reload();
                      }
                    })
                  }else{
                      console.log('Error:', data);
                      Swal.fire(
                        'Sorry!!',
                        'Something wrong this proccess',
                        'error'
                      )
                  }
              },
              error: function(data) {
                  console.log('Error:', data);
                  Swal.fire(
                    'Sorry!!',
                    'Something wrong this proccess',
                    'error'
                  )
              }
          });
        }
      })
  }
</script>
@endsection