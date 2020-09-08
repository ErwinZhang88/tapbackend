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
        <h1>Edit Setting</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Setting</li>
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
        <h3 class="card-title">Edit Setting</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
        </div>
        <!-- /.card-header -->
        <form class="forms-sample" method="POST" action="{{ $item ? route('admin.home.update',['eventid' => $eventid,'id' => $item->id]) : route('admin.home.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item)
            {{ method_field('PUT') }}
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Detail</label>
                        <input type="hidden" class="form-control" name="type" id="exampleInputEmail1" 
                            value="{{ $item ? $item->type : '' }}" placeholder="Enter key" autocomplete="off">
                        <input type="text" class="form-control" name="key" id="exampleInputEmail1" 
                            value="{{ $item ? $item->key : '' }}" placeholder="Enter key" disabled autocomplete="off">
                    </div>
                    @php
                        $datamenu = array(1,2,3,4);
                    @endphp
                    @if(in_array($item->id,$datamenu))
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name (ID)</label>
                        <input type="text" class="form-control" name="display_name" id="exampleInputEmail1" 
                            value="{{ $item ? $item->display_name : '' }}" placeholder="Enter Name (ID)" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name (EN)</label>
                        <input type="text" class="form-control" name="value" id="exampleInputEmail1" 
                            value="{{ $item ? $item->value : '' }}" placeholder="Enter Name (EN)" required autocomplete="off">
                    </div>
                    @else
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="display_name" id="exampleInputEmail1" 
                            value="{{ $item ? $item->display_name : '' }}" placeholder="Enter Name" required autocomplete="off">
                    </div>
                    @endif
                    @if($item->type == 3)
                    <div class="form-group">
                        <label for="exampleInputEmail1">Value</label>
                        <input type="text" class="form-control" name="value" id="exampleInputEmail1"
                            value="{{ $item ? $item->value : '' }}" placeholder="Enter Value" required autocomplete="off">
                    </div>
                    <div class="form-group" id="img">
                        <label>Image Background</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="image">
                        </div>
                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    </div>
                    @if($item && $item->image != '')
                    <div class="form-group">
                        <label>Image Existing</label>
                        <div>
                            <img src="{{ $item->image }}" style="width:100px;">
                        </div>
                    </div>
                    @endif
                    @elseif($item->type == 2)
                    <div class="form-group" id="img">
                        <label>Image Background</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="image">
                        </div>
                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    </div>
                    @if($item && $item->image != '')
                    <div class="form-group">
                        <label>Image Existing</label>
                        <div>
                            <img src="{{ $item->image }}" style="width:100px;">
                        </div>
                    </div>
                    @endif
                    @elseif($item->type == 1)
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
                    @elseif($item->type == 4)
                    <div class="form-group">
                        <label for="exampleInputEmail1">Value</label>
                        <input type="text" class="form-control" name="value" id="exampleInputEmail1"
                            value="{{ $item ? $item->value : '' }}" placeholder="Enter Value" required autocomplete="off">
                    </div>
                    @endif

                <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
        <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div style="float:right;">
                <a href="{{ route('admin.content',$eventid) }}" class="btn btn-danger">Cancel</a>
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
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
    $('#lfm').filemanager('image', {prefix: "{{ url('/') }}"+"/laravel-filemanager"});
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        bsCustomFileInput.init();
    })
    @if($item->type == 'text_area')
    var editor_config = {
        directionality: document.dir,
        path_absolute: "{{ url('/') }}"+"/",
        selector: "textarea[name=value]",
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
    @endif

    tinymce.init(editor_config);
</script>
@endsection