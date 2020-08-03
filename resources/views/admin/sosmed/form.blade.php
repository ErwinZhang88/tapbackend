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
        <h1>Edit Social Media</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Social Media</li>
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
        <h3 class="card-title">Edit Social Media</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
        </div>
        <!-- /.card-header -->
        <form class="forms-sample" method="POST" action="{{ $item ? route('admin.sosmed.update',$item->id) : route('admin.sosmed.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item)
            {{ method_field('PUT') }}
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="display_name" id="exampleInputEmail1" 
                            value="{{ $item ? $item->display_name : '' }}" placeholder="Enter Name" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Link</label>
                        <input type="text" class="form-control" name="link" id="exampleInputEmail1"
                            value="{{ $item ? $item->link : '' }}" placeholder="Enter Link" required autocomplete="off">
                    </div>
                    <div class="form-group" id="img">
                        <label>Value</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="value">
                        </div>
                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    </div>
                    @if($item && $item->value != '')
                    <div class="form-group">
                        <label>Value Existing</label>
                        <div>
                            <img src="{{ $item->value }}" style="width:40px;">
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="exampleInputEmail1">Urutan</label>
                        <input type="number" class="form-control" name="order" id="exampleInputEmail1"
                            value="{{ $item ? $item->order : '' }}" placeholder="Urutan" required autocomplete="off">
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
                <a href="{{ route('admin.banner.index') }}" class="btn btn-danger">Cancel</a>
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
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
    $('#lfm').filemanager('image', {prefix: "{{ url('/') }}"+"/laravel-filemanager"});
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        bsCustomFileInput.init();
    })
</script>
@endsection