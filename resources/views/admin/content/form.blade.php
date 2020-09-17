@extends('layouts.admin')

@section('style')
  <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admins/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .color1{
            background-color: #FFFFFF;
        }
        .color2{
            background-color: #000000;
        }
        .color3{
            background-color: #057249;
        }
        .color4{
            background-color: #19AE4F;
        }
        .color5{
            background-color: #649743;
        }
        .color6{
            background-color: #6CCB3D;
        }
        .color7{
            background-color: #929292;
        }
        .color8{
            background-color: #AEAEAE;
        }
        .color9{
            background-color: #C8D4B8;
        }
        .color10{
            background-color: #D9DED2;
        }
        .color11{
            background-color: #F0EDDC;
        }
        .color12{
            background-color: #E9ECE5;
        }
        .color13{
            background-color: #727272;
        }
        .color14{
            background-color: #989898;
        }
        .color15{
            background-color: #5A5A5A;
        }
        .color16{
            background-color: #CB9F49;
        }
    </style>
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
                    @if($item && $item['content']->format)
                    <img src="{{ url('/format/format_'.$item['content']->format.'.png') }}" name="image-swap" style="width:10%;">
                    @else
                    <img src="{{ url('/format/format_1.png') }}" name="image-swap" style="width:10%;">
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label>Background Color</label>
                <select class="form-control select2" name="bg_color" id="bg_color" style="width: 100%;">
                    <option value="#FFFFFF" class="color1" {{ $item && $item['content']->bg_color == '#FFFFFF' ? 'selected="selected"' : '' }}>#FFFFFF</option>
                    <option value="#000000" class="color2" {{ $item && $item['content']->bg_color == '#000000' ? 'selected="selected"' : '' }}>#000000</option>
                    <option value="#057249" class="color3" {{ $item && $item['content']->bg_color == '#057249' ? 'selected="selected"' : '' }}>#057249</option>
                    <option value="#19AE4F" class="color4" {{ $item && $item['content']->bg_color == '#19AE4F' ? 'selected="selected"' : '' }}>#19AE4F</option>
                    <option value="#649743" class="color5" {{ $item && $item['content']->bg_color == '#649743' ? 'selected="selected"' : '' }}>#649743</option>
                    <option value="#6CCB3D" class="color6" {{ $item && $item['content']->bg_color == '#6CCB3D' ? 'selected="selected"' : '' }}>#6CCB3D</option>
                    <option value="#929292" class="color7" {{ $item && $item['content']->bg_color == '#929292' ? 'selected="selected"' : '' }}>#929292</option>
                    <option value="#AEAEAE" class="color8" {{ $item && $item['content']->bg_color == '#AEAEAE' ? 'selected="selected"' : '' }}>#AEAEAE</option>
                    <option value="#C8D4B8" class="color9" {{ $item && $item['content']->bg_color == '#C8D4B8' ? 'selected="selected"' : '' }}>#C8D4B8</option>
                    <option value="#D9DED2" class="color10" {{ $item && $item['content']->bg_color == '#D9DED2' ? 'selected="selected"' : '' }}>#D9DED2</option>
                    <option value="#F0EDDC" class="color11" {{ $item && $item['content']->bg_color == '#F0EDDC' ? 'selected="selected"' : '' }}>#F0EDDC</option>
                    <option value="#E9ECE5" class="color12" {{ $item && $item['content']->bg_color == '#E9ECE5' ? 'selected="selected"' : '' }}>#E9ECE5</option>
                    <option value="#727272" class="color13" {{ $item && $item['content']->bg_color == '#727272' ? 'selected="selected"' : '' }}>#727272</option>
                    <option value="#989898" class="color14" {{ $item && $item['content']->bg_color == '#989898' ? 'selected="selected"' : '' }}>#989898</option>
                    <option value="#5A5A5A" class="color15" {{ $item && $item['content']->bg_color == '#5A5A5A' ? 'selected="selected"' : '' }}>#5A5A5A</option>
                    <option value="#CB9F49" class="color16" {{ $item && $item['content']->bg_color == '#CB9F49' ? 'selected="selected"' : '' }}>#CB9F49</option>
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
                            <div class="form-group" id="shortdesc">
                                <label for="exampleInputEmail1">Deskripsi Singkat(ID)</label>
                                <textarea name="shortdesc" class="form-control">{{ ($item && $item['translations']) ? $item['translations']->short_desc : '' }}
                                </textarea>
                            </div>
                            <div class="form-group" id="desc">
                                <label for="exampleInputEmail1">Deskripsi (ID)</label>
                                <textarea name="desc" class="form-control">{{ ($item && $item['translations']) ? $item['translations']->description : '' }}
                                </textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
                            <div class="form-group" id="title">
                                <label for="exampleInputEmail1">Title (EN)</label>
                                <input type="text" class="form-control" name="titleEn" id="exampleInputEmail1"
                                    value="{{ ($item && $item['translations_en']) ? $item['translations_en']->name : '' }}" placeholder="Enter Title">
                            </div>
                            <div class="form-group" id="shortdescEn">
                                <label for="exampleInputEmail1">Deskripsi Singkat (EN)</label>
                                <textarea name="shortdescEn" class="form-control">{{ ($item && $item['translations_en']) ? $item['translations_en']->short_desc : '' }}
                                </textarea>
                            </div>
                            <div class="form-group" id="descEn">
                                <label for="exampleInputEmail1">Description (EN)</label>
                                <textarea name="descEn" class="form-control">{{ ($item && $item['translations_en'])  ? $item['translations_en']->description : '' }}
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
                <label>Image Mobile</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm4" data-input="thumbnail4" data-preview="holder4" class="btn btn-primary text-white">
                        <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail4" class="form-control" type="text" name="image_mobile">
                </div>
                <div id="holder4" style="margin-top:15px;max-height:100px;"></div>
            </div>
            @if($item && $item['content']->image_mobile != '')
            <div class="form-group">
                <label>Image Mobile Existing</label>
                <div>
                    <img src="{{ $item['content']->image_mobile }}" style="width:120px;">
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
            <div class="form-group">
                <label>Status File Download</label>
                <select class="form-control select2" name="is_download" style="width: 100%;">
                    <option value="1" {{ ($item && $item['content']->is_download == 1) ? 'selected="selected"' : ''}}>Download</option>
                    <option value="2" {{ ($item && $item['content']->is_download == 2) ? 'selected="selected"' : ''}}>View File</option>
                </select>
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
    var show_details = "{{ $item && $item['content']->button ? $item['content']->button : 0 }}";
    console.log(show_details);
    var editor_config = {
        directionality: document.dir,
        path_absolute: "{{ url('/') }}"+"/",
        selector: "textarea[name=desc]",
        plugins: [
        "link image code lists advlist paste insertdatetime media table contextmenu textcolor"
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code | fontselect fontsizeselect | forecolor backcolor',
        powerpaste_allow_local_images: true,
        powerpaste_word_import: 'prompt',
        powerpaste_html_import: 'prompt',
        paste_text_sticky : true,
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
    var shorteditor_config = {
        directionality: document.dir,
        path_absolute: "{{ url('/') }}"+"/",
        selector: "textarea[name=shortdesc]",
        plugins: [
        "link image code lists advlist paste insertdatetime media table contextmenu textcolor"
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code | fontselect fontsizeselect | forecolor backcolor',
        relative_urls: false,
        remove_script_host : false,
        convert_urls : true,
        height: 150,
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

    tinymce.init(shorteditor_config);

    var editor_configEn = {
        directionality: document.dir,
        path_absolute: "{{ url('/') }}"+"/",
        selector: "textarea[name=descEn]",
        plugins: [
        "link image code lists advlist paste insertdatetime media table contextmenu textcolor"
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code | fontselect fontsizeselect | forecolor backcolor',
        powerpaste_allow_local_images: true,
        powerpaste_word_import: 'prompt',
        powerpaste_html_import: 'prompt',
        paste_text_sticky : true,
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
    var shorteditor_configEn = {
        directionality: document.dir,
        path_absolute: "{{ url('/') }}"+"/",
        selector: "textarea[name=shortdescEn]",
        plugins: [
        "link image code lists advlist paste insertdatetime media table contextmenu textcolor"
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code | fontselect fontsizeselect | forecolor backcolor',
        relative_urls: false,
        remove_script_host : false,
        convert_urls : true,
        height: 150,
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

    tinymce.init(shorteditor_configEn);
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
    var lfm2 = function(id, type, options) {
      let button = document.getElementById(id);

      button.addEventListener('click', function () {
        var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
        var target_input = document.getElementById(button.getAttribute('data-input'));
        var target_preview = document.getElementById(button.getAttribute('data-preview'));

        window.open(route_prefix + '?type=images', 'FileManager', 'width=900,height=600');
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
    lfm2('lfm4', 'file', {prefix: route_prefix});
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        $("#shortdesc").hide();
        $("#shortdescEn").hide();
        if(show_details == 1){
            $("#shortdesc").show();
            $("#shortdescEn").show();
        }
        var types = "{{ $item && $item['content']->type ? $item['content']->type : 1 }}";
        if(types == 1){
            $("#title").show();
            $("#desc").show();
            $("#descEn").show();
            $("#img").show();
        }else if(types == 2){
            $("#title").show();
            $("#desc").show();
            $("#descEn").show();
            $("#img").hide();
        }else{
            $("#title").show();
            $("#desc").hide();
            $("#descEn").hide();
            $("#img").show();
        }
        $("#format").change(function(){
            console.log('val->',$(this).val());
            $("img[name=image-swap]").attr("src",route_img + '/format/format_' + $(this).val() + '.png' );
        });
        $("#button").change(function(){
            console.log('valbutton->',$(this).val());
            if($(this).val() == 1){
                $("#shortdesc").show();
                $("#shortdescEn").show();
            }else{
                $("#shortdesc").hide();
                $("#shortdescEn").hide();
            }
        });
    })
    function checkType() {
        var x = document.getElementById("type").value;
        if(x == 1){
            $("#title").show();
            $("#desc").show();
            $("#descEn").show();
            $("#img").show();
        }else if(x == 2){
            $("#title").show();
            $("#desc").show();
            $("#descEn").show();
            $("#img").hide();
        }else{
            $("#title").show();
            $("#hide").show();
            $("#img").show();
        }
    }
</script>
@endsection