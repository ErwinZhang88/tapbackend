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
        <h1>Edit Menu</h1>
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
        <h3 class="card-title">Edit Menu</h3>

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
                    @if(Auth::user()->id == 1)
                    <div class="form-group">
                        <label for="exampleInputEmail1">Path</label>
                        <input type="text" class="form-control" name="path" id="exampleInputEmail1"
                            value="{{ $item ? $item->path : '' }}" placeholder="Enter Path" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Comp Name</label>
                        <input type="text" class="form-control" name="comp_name" id="exampleInputEmail1"
                            value="{{ $item ? $item->comp_name : '' }}" placeholder="Enter Comp Name" required autocomplete="off">
                    </div>
                    @endif
                    @if(!$item)
                    <div class="form-group">
                        <label>Parent Menu</label>
                        <select class="form-control select2" name="parent_id" style="width: 100%;">
                            <option value="0" selected="selected">-- Parent Menu --</option>
                            @foreach($menu as $row)
                            <option value="{{ $row->id }}">{{ $row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="form-group" id="img">
                        <label>Image Banner</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="banner">
                        </div>
                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    </div>
                    @if($item && $item->banner != '')
                    <div class="form-group">
                        <label>Image Banner Existing</label>
                        <div>
                            <img src="{{ $item->banner }}" style="width:120px;">
                        </div>
                    </div>
                    @endif
                    <div class="form-group" id="img">
                        <label>Image Banner Mobile</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm3" data-input="thumbnail3" data-preview="holder3" class="btn btn-primary text-white">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail3" class="form-control" type="text" name="banner_mobile">
                        </div>
                        <div id="holder3" style="margin-top:15px;max-height:100px;"></div>
                    </div>
                    @if($item && $item->banner_mobile != '')
                    <div class="form-group">
                        <label>Image Banner Mobile Existing</label>
                        <div>
                            <img src="{{ $item->banner_mobile }}" style="width:120px;">
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
                    @if($item && $item->icon != '')
                    <div class="form-group">
                        <label>Image Icon Existing</label>
                        <div>
                            <img src="{{ $item->icon }}" style="width:120px;">
                        </div>
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
   var route_prefix = "{{ url('/filemanager') }}";
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
    var lfm1 = function(id, type, options) {
      let button = document.getElementById(id);

      button.addEventListener('click', function () {
        // var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
        var route_prefix = "{{ url('/') }}/filemanager";
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
    lfm1('lfm3', 'file', {prefix: route_prefix});
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    bsCustomFileInput.init();

  })
</script>
@endsection