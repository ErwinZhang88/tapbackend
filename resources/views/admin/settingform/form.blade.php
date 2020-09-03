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
        <h1>Edit Setting Form Keluhan</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Setting Form Keluhan</li>
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
        <h3 class="card-title">Edit Setting Form Keluhan</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
        </div>
        <!-- /.card-header -->
        <form class="forms-sample" method="POST" action="{{ $item ? route('admin.settingform.update',$item->id) : route('admin.settingform.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item)
            {{ method_field('PUT') }}
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Select Type</label>
                        <select class="form-control select2" name="type" id="show_type" style="width: 100%;">
                            <option value="0" {{ $item && $item->type == 0 ? 'selected="selected"' : '' }}>Text</option>
                            <option value="1" {{ $item && $item->type == 1 ? 'selected="selected"' : '' }}>Number</option>
                            <option value="2" {{ $item && $item->type == 2 ? 'selected="selected"' : '' }}>Email</option>
                            <option value="3" {{ $item && $item->type == 3 ? 'selected="selected"' : '' }}>TextArea</option>
                            <option value="4" {{ $item && $item->type == 4 ? 'selected="selected"' : '' }}>File</option>
                            <option value="5" {{ $item && $item->type == 5 ? 'selected="selected"' : '' }}>Radio Button</option>
                            <!-- <option value="6" {{ $item && $item->type == 6 ? 'selected="selected"' : '' }}>CheckBox</option> -->
                            <option value="7" {{ $item && $item->type == 7 ? 'selected="selected"' : '' }}>Title</option>
                            <option value="8" {{ $item && $item->type == 8 ? 'selected="selected"' : '' }}>Button</option>
                            <option value="9" {{ $item && $item->type == 9 ? 'selected="selected"' : '' }}>Button File</option>
                            <option value="10" {{ $item && $item->type == 10 ? 'selected="selected"' : '' }}>Message Error</option>
                            <option value="11" {{ $item && $item->type == 11 ? 'selected="selected"' : '' }}>Email Error</option>
                            <option value="12" {{ $item && $item->type == 12 ? 'selected="selected"' : '' }}>Label Table</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Is Required</label>
                        <select class="form-control select2" name="is_required" id="is_required" style="width: 100%;">
                            <option value="0" {{ $item && $item->is_required == 0 ? 'selected="selected"' : '' }}>No</option>
                            <option value="1" {{ $item && $item->is_required == 1 ? 'selected="selected"' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name (ID)</label>
                        <input type="text" class="form-control" name="value" id="exampleInputEmail1" 
                            value="{{ $item ? $item->value : '' }}" placeholder="Enter Name" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name (EN)</label>
                        <input type="text" class="form-control" name="valueEn" id="exampleInputEmail1" 
                            value="{{ $item ? $item->valueEn : '' }}" placeholder="Enter Name" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Is Placeholder</label>
                        <select class="form-control select2" name="is_placeholder" id="is_placeholder" style="width: 100%;">
                            <option value="0" {{ $item && $item->is_placeholder == 0 ? 'selected="selected"' : '' }}>No</option>
                            <option value="1" {{ $item && $item->is_placeholder == 1 ? 'selected="selected"' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div class="form-group" id="placeholder">
                        <label for="exampleInputEmail1">Placeholder (ID)</label>
                        <input type="text" class="form-control" name="placeholder" id="exampleInputEmail1" 
                            value="{{ $item ? $item->placeholder : '' }}" placeholder="Enter Name" autocomplete="off">
                    </div>
                    <div class="form-group" id="placeholderen">
                        <label for="exampleInputEmail1">Placeholder (EN)</label>
                        <input type="text" class="form-control" name="display_name" id="exampleInputEmail1" 
                            value="{{ $item ? $item->placeholderEn : '' }}" placeholder="Enter Name" autocomplete="off">
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
                <a href="{{ route('admin.settingform.index') }}" class="btn btn-danger">Cancel</a>
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
<!-- TinyMCE init -->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    var showplaceholder = "{{ $item && $item->is_placeholder == 1 ? 1 : 0}}";
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
    $('#lfm').filemanager('image', {prefix: "{{ url('/') }}"+"/laravel-filemanager"});
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        bsCustomFileInput.init();
        $("#placeholder").hide();
        $("#placeholderen").hide();
        if(showplaceholder == 1){
                $("#placeholder").show();
                $("#placeholderen").show();
        }
        $("#is_placeholder").change(function(){
            console.log('valbutton->',$(this).val());
            if($(this).val() == 1){
                $("#placeholder").show();
                $("#placeholderen").show();
            }else{
                $("#placeholder").hide();
                $("#placeholderen").hide();
            }
        });
    })
</script>
@endsection