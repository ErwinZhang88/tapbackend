@extends('layouts.admin')

@section('style')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('admins/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Create Menu</h1>
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
        <h3 class="card-title">Create Menu</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
        </div>
        <!-- /.card-header -->
        <form class="forms-sample" method="POST" action="{{ $item ? route('admin.menu.update',$item->id) : route('admin.menu.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item)
            {{ method_field('PUT') }}
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name (ID)</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" 
                            value="{{ $item ? $item->name : '' }}" placeholder="Enter Name (ID)" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name (EN)</label>
                        <input type="text" class="form-control" name="nameEn" id="exampleInputEmail1"
                            value="{{ $item ? $item->nameEn : '' }}" placeholder="Enter Name (EN)" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Parent Menu</label>
                        <select class="form-control select2" name="parent_id" style="width: 100%;">
                            <option value="0" selected="selected">-- Parent Menu --</option>
                            @foreach($menu as $row)
                            <option value="{{ $row->id }}" {{ $item && $item->parent_id == $row->id  ?? 'selected="selected"' }}>{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Image Banner</label>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="banner" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile1">Image Icon</label>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="icon" class="custom-file-input" id="exampleInputFile1">
                            <label class="custom-file-label" for="exampleInputFile1">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                        </div>
                        </div>
                    </div>

                <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
        <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div style="float:right;">
                <a href="{{ route('admin.menu.index') }}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('script')
<!-- Select2 -->
<script src="{{ asset('admins/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('admins/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    bsCustomFileInput.init();

  })
</script>
@endsection