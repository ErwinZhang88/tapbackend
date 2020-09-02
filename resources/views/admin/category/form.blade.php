@extends('layouts.admin')

@section('style')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('admins/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Create Category</h1>
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
        <h3 class="card-title">Create Category</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
        </div>
        <!-- /.card-header -->
        <form class="forms-sample" method="POST" action="{{ $item ? route('admin.category.update',$item->id) : route('admin.category.store') }}" enctype="multipart/form-data">
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
                        <input type="text" class="form-control" name="nameEn" id="exampleInputEmail"
                            value="{{ $item ? $item->nameEn : '' }}" placeholder="Enter Name (EN)" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Show Title</label>
                        <select class="form-control select2" name="show_name" id="show_title" style="width: 100%;">
                            <option value="0" {{ $item && $item->show_name == 0 ? 'selected="selected"' : '' }}>No</option>
                            <option value="1" {{ $item && $item->show_name == 1 ? 'selected="selected"' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Menu</label>
                        <select class="form-control select2" name="menu_id" style="width: 100%;">
                            @foreach($menu as $row)
                            <option value="{{ $row->id }}" {{ $item && $item->menu_id == $row->id ? 'selected="selected"' : '' }}>
                                {{ $row->name }} - ({{ $row->parent_id != 0 ? 'SubMenu' : 'Menu' }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control select2" name="type" style="width: 100%;">
                            <option value="1" {{ $item && $item->type == 1 ? 'selected="selected"' : ''}}>Article</option>
                            <option value="2" {{ $item && $item->type == 2 ? 'selected="selected"' : '' }}>Image</option>
                            <option value="3" {{ $item && $item->type == 3 ? 'selected="selected"' : '' }}>List</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pagination</label>
                        <select class="form-control select2" name="pagination" id="pagination" style="width: 100%;">
                            <option value="0" {{ $item && $item->pagination == 0 ? 'selected="selected"' : '' }}>No</option>
                            <option value="1" {{ $item && $item->pagination == 1 ? 'selected="selected"' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div class="form-group" id="limitpage">
                        <label for="exampleInputEmail1">Limit Per Page</label>
                        <input type="number" class="form-control" name="limitpage" id="limitpages"
                            value="{{ $item ? $item->limitpage : 0 }}" placeholder="Enter Limit Page" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Sort Content</label>
                        <select class="form-control select2" name="is_sort" id="is_sort" style="width: 100%;">
                            <option value="1" {{ $item && $item->is_sort == 1 ? 'selected="selected"' : '' }}>Asc</option>
                            <option value="0" {{ $item && $item->is_sort == 0 ? 'selected="selected"' : '' }}>Desc</option>
                        </select>
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
                <a href="{{ route('admin.category.index') }}" class="btn btn-danger">Cancel</a>
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
<script>
var pagination = "{{ $item && $item->pagination ? $item->pagination : 0 }}";
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $("#limitpage").hide();

    if(pagination == 1){
        $("#limitpage").show();
    }

    $("#pagination").change(function(){
        console.log('valbutton->',$(this).val());
        if($(this).val() == 1){
            $("#limitpage").show();
        }else{
            $("#limitpage").hide();
        }
    });
  })
</script>
@endsection