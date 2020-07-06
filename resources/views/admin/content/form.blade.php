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
        <h1>Add Content</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Content</li>
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
        <h3 class="card-title">Add Content</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
        </div>
        <!-- /.card-header -->
        <form class="forms-sample" method="POST" action="{{ $item ? route('admin.content.update',['eventid' => $id,'id' => $item['content']->id]) : route('admin.content.store',['eventid' => $id]) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item)
            {{ method_field('PUT') }}
        @endif
        <div class="card-body">
            <div class="form-group">
                <label>Type</label>
                <select class="form-control select2" name="type" id="type" style="width: 100%;" onchange="checkType()">
                    <option value="1" {{ $item && $item['content']->type == 1 ? 'selected="selected"' : '' }}>Title + Description + Image</option>
                    <option value="2" {{ $item && $item['content']->type == 2 ? 'selected="selected"' : '' }}>Title + Description</option>
                    <option value="3" {{ $item && $item['content']->type == 3 ? 'selected="selected"' : '' }}>Image</option>
                </select>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select class="form-control select2" name="category_id" style="width: 100%;">
                    @foreach($category as $row)
                    <option value="{{ $row->id }}" {{ $item && $item['content']->category_id == $row->id ? 'selected="selected"' : '' }}>{{ $row->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row" id="titledesc">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true">ID</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-content-above-profile-tab" data-toggle="pill" href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile" aria-selected="false">EN</a>
                        </li>
                    </ul>
                    <div class="tab-custom-content">
                        <p class="lead mb-0">Custom Content goes here</p>
                    </div>
                    <div class="tab-content" id="custom-content-above-tabContent">
                        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Judul (ID)</label>
                                <input type="text" class="form-control" name="title" id="exampleInputEmail1"
                                    value="{{ $item ? $item['translations']->name : '' }}" placeholder="Masukkan Judul">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Deskripsi (ID)</label>
                                <textarea name="desc" class="form-control">
                                    {{ $item ? $item['translations']->description : '' }}
                                </textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title (EN)</label>
                                <input type="text" class="form-control" name="titleEn" id="exampleInputEmail1"
                                    value="{{ $item ? $item['translations_en']->name : '' }}" placeholder="Enter Title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description (EN)</label>
                                <textarea name="descEn" class="form-control">
                                    {{ $item ? $item['translations_en']->description : '' }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <div class="form-group" id="img">
                <label>Image</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                        <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="filepath">
                </div>
            </div>
        <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div style="float:right;">
                <a href="{{ route('admin.content',['eventid' => $id]) }}" class="btn btn-danger">Cancel</a>
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
<!-- TinyMCE init -->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    var editor_config = {
        directionality: document.dir,
        path_absolute: "{{ url('/') }}"+"/",
        selector: "textarea[name=desc]",
        plugins: [
        "link image"
        ],
        relative_urls: false,
        height: 300,
        file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
            file : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no"
        });
        }
    };

    tinymce.init(editor_config);

    var editor_configEn = {
        directionality: document.dir,
        path_absolute: "{{ url('/') }}"+"/",
        selector: "textarea[name=descEn]",
        plugins: [
        "link image"
        ],
        relative_urls: false,
        height: 300,
        file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
            file : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no"
        });
        }
    };

    tinymce.init(editor_configEn);
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
    $('#lfm').filemanager('image', {prefix: "{{ url('/') }}"+"/laravel-filemanager"});
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        var types = "{{ $item && $item['content']->type ? $item['content']->type : 1 }}";
        if(types == 1){
            $("#titledesc").show();
            $("#img").show();
        }else if(types == 2){
            $("#titledesc").show();
            $("#img").hide();
        }else{
            $("#titledesc").hide();
            $("#img").show();
        }
    })
    function checkType() {
        var x = document.getElementById("type").value;
        if(x == 1){
            $("#titledesc").show();
            $("#img").show();
        }else if(x == 2){
            $("#titledesc").show();
            $("#img").hide();
        }else{
            $("#titledesc").hide();
            $("#img").show();
        }
    }
</script>
@endsection