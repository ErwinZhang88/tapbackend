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
                    <option value="3" {{ $item && $item['content']->type == 3 ? 'selected="selected"' : '' }}>Title + Image</option>
                    <option value="4" {{ $item && $item['content']->type == 4 ? 'selected="selected"' : '' }}>Title + Youtube + Icon</option>
                </select>
            </div>
            <div class="form-group">
                <label>Format</label>
                <select class="form-control select2" name="format" id="format" style="width: 100%;">
                    @for($i=1;$i<=13;$i++)
                    <option value="{{ $i }}" {{ $item && $item['content']->format == $i ? 'selected="selected"' : '' }}>Format - {{ $i }}</option>
                    @endfor
                </select>
                <div id="imgshow" style="margin-top:15px;max-height:100px;">
                    <img src="{{ url('/format/format_1.png') }}" name="image-swap" style="width:10%;">
                </div>
            </div>
            <div class="form-group">
                <label>Background Color</label>
                <select class="form-control select2" name="bg_color" id="bg_color" style="width: 100%;">
                    <option value="#FFFFFF" {{ $item && $item['content']->bg_color == '#FFFFFF' ? 'selected="selected"' : '' }}>#FFFFFF</option>
                    <option value="#000000" {{ $item && $item['content']->bg_color == '#000000' ? 'selected="selected"' : '' }}>#000000</option>
                    <option value="#057249" {{ $item && $item['content']->bg_color == '#057249' ? 'selected="selected"' : '' }}>#057249</option>
                    <option value="#19AE4F" {{ $item && $item['content']->bg_color == '#19AE4F' ? 'selected="selected"' : '' }}>#19AE4F</option>
                    <option value="#649743" {{ $item && $item['content']->bg_color == '#649743' ? 'selected="selected"' : '' }}>#649743</option>
                    <option value="#6CCB3D" {{ $item && $item['content']->bg_color == '#6CCB3D' ? 'selected="selected"' : '' }}>#6CCB3D</option>
                    <option value="#929292" {{ $item && $item['content']->bg_color == '#929292' ? 'selected="selected"' : '' }}>#929292</option>
                    <option value="#AEAEAE" {{ $item && $item['content']->bg_color == '#AEAEAE' ? 'selected="selected"' : '' }}>#AEAEAE</option>
                    <option value="#C8D4B8" {{ $item && $item['content']->bg_color == '#C8D4B8' ? 'selected="selected"' : '' }}>#C8D4B8</option>
                    <option value="#D9DED2" {{ $item && $item['content']->bg_color == '#D9DED2' ? 'selected="selected"' : '' }}>#D9DED2</option>
                    <option value="#F0EDDC" {{ $item && $item['content']->bg_color == '#F0EDDC' ? 'selected="selected"' : '' }}>#F0EDDC</option>
                    <option value="#E9ECE5" {{ $item && $item['content']->bg_color == '#E9ECE5' ? 'selected="selected"' : '' }}>#E9ECE5</option>
                    <option value="#727272" {{ $item && $item['content']->bg_color == '#727272' ? 'selected="selected"' : '' }}>#727272</option>
                    <option value="#989898" {{ $item && $item['content']->bg_color == '#989898' ? 'selected="selected"' : '' }}>#989898</option>
                    <option value="#5A5A5A" {{ $item && $item['content']->bg_color == '#5A5A5A' ? 'selected="selected"' : '' }}>#5A5A5A</option>
                    <option value="#CB9F49" {{ $item && $item['content']->bg_color == '#CB9F49' ? 'selected="selected"' : '' }}>#CB9F49</option>
                    <option value="#CB4949" {{ $item && $item['content']->bg_color == '#CB4949' ? 'selected="selected"' : '' }}>#CB4949</option>
                </select>
            </div>
            <div class="form-group">
                <label>Button (Details)</label>
                <select class="form-control select2" name="button" id="button" style="width: 100%;">
                    <option value="0" {{ $item && $item['content']->button == 0 ? 'selected="selected"' : '' }}>No</option>
                    <option value="1" {{ $item && $item['content']->button == 1 ? 'selected="selected"' : '' }}>Yes</option>
                </select>
            </div>
            <div class="form-group">
                <label>Show Title</label>
                <select class="form-control select2" name="show_title" id="show_title" style="width: 100%;">
                    <option value="0" {{ $item && $item['content']->show_title == 0 ? 'selected="selected"' : '' }}>No</option>
                    <option value="1" {{ $item && $item['content']->show_title == 1 ? 'selected="selected"' : '' }}>Yes</option>
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
            <div class="row">
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
                            <div class="form-group" id="title">
                                <label for="exampleInputEmail1">Judul (ID)</label>
                                <input type="text" class="form-control" name="title" id="exampleInputEmail1"
                                    value="{{ ($item && $item['translations']) ? $item['translations']->name : '' }}" placeholder="Masukkan Judul">
                            </div>
                            <div class="form-group" id="desc">
                                <label for="exampleInputEmail1">Deskripsi (ID)</label>
                                <textarea name="desc" class="form-control">
                                    {{ ($item && $item['translations']) ? $item['translations']->description : '' }}
                                </textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
                            <div class="form-group" id="title">
                                <label for="exampleInputEmail1">Title (EN)</label>
                                <input type="text" class="form-control" name="titleEn" id="exampleInputEmail1"
                                    value="{{ ($item && $item['translations_en']) ? $item['translations_en']->name : '' }}" placeholder="Enter Title">
                            </div>
                            <div class="form-group" id="desc">
                                <label for="exampleInputEmail1">Description (EN)</label>
                                <textarea name="descEn" class="form-control">
                                    {{ ($item && $item['translations_en'])  ? $item['translations_en']->description : '' }}
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
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
            </div>
            @if($item && $item['content']->images != '')
            <div class="form-group">
                <label>Image Existing</label>
                <div>
                    <img src="{{ $item['content']->images }}" style="width:120px;">
                </div>
            </div>
            @endif
            <div class="form-group" id="img">
                <label>Image Icon</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm2" data-input="thumbnail2" data-preview="holder2" class="btn btn-primary text-white">
                        <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail2" class="form-control" type="text" name="icon">
                </div>
                <div id="holder2" style="margin-top:15px;max-height:100px;"></div>
            </div>
            @if($item && $item['content']->icon != '')
            <div class="form-group">
                <label>Icon Existing</label>
                <div>
                    <img src="{{ $item['content']->icon }}" style="width:120px;">
                </div>
            </div>
            @endif
            <div class="form-group">
                <label for="exampleInputEmail1">Link Video</label>
                <input type="text" class="form-control" name="video" id="exampleInputEmail1" 
                    value="{{ $item ? $item['content']->video : '' }}" placeholder="Enter Name Video" autocomplete="off">
            </div>
            <div class="form-group" id="img">
                <label>File to Download</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm3" data-input="thumbnail3" data-preview="holder3" class="btn btn-primary text-white">
                        <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail3" class="form-control" type="text" name="filedownload" {{ $item ? $item['content']->files : '' }}>
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
    var route_prefix = "{{ url('/filemanager') }}";
    var route_img = "{{ url('/') }}";
    var editor_config = {
        directionality: document.dir,
        path_absolute: "{{ url('/') }}"+"/",
        selector: "textarea[name=desc]",
        plugins: [
        "link image code"
        ],
        relative_urls: false,
        remove_script_host : false,
        convert_urls : true,
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
            close_previous : "no",
        });
        }
    };

    tinymce.init(editor_config);

    var editor_configEn = {
        directionality: document.dir,
        path_absolute: "{{ url('/') }}"+"/",
        selector: "textarea[name=descEn]",
        plugins: [
        "link image code"
        ],
        relative_urls: false,
        remove_script_host : false,
        convert_urls : true,
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

    var lfm = function(id, type, options) {
      let button = document.getElementById(id);

      button.addEventListener('click', function () {
        var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
        var target_input = document.getElementById(button.getAttribute('data-input'));
        var target_preview = document.getElementById(button.getAttribute('data-preview'));

        window.open(route_prefix + '?type=image', 'FileManager', 'width=900,height=600');
        window.SetUrl = function (items) {
          var file_path = items.map(function (item) {
            return item.url;
          }).join(',');

          // set the value of the desired input to image url
          target_input.value = file_path;
          target_input.dispatchEvent(new Event('change'));

          // clear previous preview
          target_preview.innerHtml = '';

          // set or change the preview image src
          items.forEach(function (item) {
            let img = document.createElement('img')
            img.setAttribute('style', 'height: 5rem')
            img.setAttribute('src', item.thumb_url)
            target_preview.appendChild(img);
          });

          // trigger change event
          target_preview.dispatchEvent(new Event('change'));
        };
      });
    };
    lfm('lfm2', 'file', {prefix: route_prefix});
    var lfm1 = function(id, type, options) {
      let button = document.getElementById(id);

      button.addEventListener('click', function () {
        var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
        var target_input = document.getElementById(button.getAttribute('data-input'));
        var target_preview = document.getElementById(button.getAttribute('data-preview'));

        window.open(route_prefix + '?type=files', 'FileManager', 'width=900,height=600');
        window.SetUrl = function (items) {
          var file_path = items.map(function (item) {
            return item.url;
          }).join(',');

          // set the value of the desired input to image url
          target_input.value = file_path;
          target_input.dispatchEvent(new Event('change'));

          // clear previous preview
          target_preview.innerHtml = '';

          // set or change the preview image src
          items.forEach(function (item) {
            let img = document.createElement('img')
            img.setAttribute('style', 'height: 5rem')
            img.setAttribute('src', item.thumb_url)
            target_preview.appendChild(img);
          });

          // trigger change event
          target_preview.dispatchEvent(new Event('change'));
        };
      });
    };
    lfm1('lfm3', 'file', {prefix: route_prefix});
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        var types = "{{ $item && $item['content']->type ? $item['content']->type : 1 }}";
        if(types == 1){
            $("#title").show();
            $("#desc").show();
            $("#img").show();
        }else if(types == 2){
            $("#title").show();
            $("#desc").show();
            $("#img").hide();
        }else{
            $("#title").show();
            $("#desc").hide();
            $("#img").show();
        }
        $("#format").change(function(){
            console.log('val->',$(this).val());
            $("img[name=image-swap]").attr("src",route_img + '/format/format_' + $(this).val() + '.png' );
        });
    })
    function checkType() {
        var x = document.getElementById("type").value;
        if(x == 1){
            $("#title").show();
            $("#desc").show();
            $("#img").show();
        }else if(x == 2){
            $("#title").show();
            $("#desc").show();
            $("#img").hide();
        }else{
            $("#title").show();
            $("#hide").show();
            $("#img").show();
        }
    }
</script>
@endsection