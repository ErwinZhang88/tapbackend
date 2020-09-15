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
        <h1>Edit Keluhan Kami</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Keluhan Kami</li>
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
        <h3 class="card-title">Edit Keluhan Kami</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
        </div>
        <!-- /.card-header -->
        <form class="forms-sample" method="POST" action="{{ $item ? route('admin.complaint.update',$item->id) : route('admin.complaint.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item)
            {{ method_field('PUT') }}
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" 
                            value="{{ $item ? $item->name : '' }}" placeholder="Enter Name" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Grup / Organisasi Anda (Jika Ada)</label>
                        <input type="text" class="form-control" name="group" id="exampleInputEmail1"
                            value="{{ $item ? $item->group : '' }}" placeholder="Enter Nama Group" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Negara</label>
                        <input type="text" class="form-control" name="country" id="exampleInputEmail1"
                            value="{{ $item ? $item->country : '' }}" placeholder="Enter Negara" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        <textarea class="form-control" rows="2" name="address" placeholder="Enter ...">
                            {{ $item ? $item->address : '' }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1"
                            value="{{ $item ? $item->phone : '' }}" placeholder="Enter Phone" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1"
                            value="{{ $item ? $item->email : '' }}" placeholder="Enter Email" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fax</label>
                        <input type="text" class="form-control" name="fax" id="exampleInputEmail1"
                            value="{{ $item ? $item->fax : '' }}" placeholder="Enter Fax" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Keluhan ditujukan Kepada</label>
                        <input type="text" class="form-control" name="keluhan_kepada" id="exampleInputEmail1"
                            value="{{ $item ? $item->keluhan_kepada : '' }}" placeholder="Enter ..." autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Responden</label>
                        <input type="text" class="form-control" name="nama_responden" id="exampleInputEmail1"
                            value="{{ $item ? $item->nama_responden : '' }}" placeholder="Enter ..." autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Lokasi Keluhan</label>
                        <textarea class="form-control" rows="2" name="lokasi_keluhan" placeholder="Enter ...">
                            {{ $item ? $item->lokasi_keluhan : '' }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Informasi Keluhan</label>
                        <textarea class="form-control" rows="2" name="informasi_keluhan" placeholder="Enter ...">{{ $item ? $item->informasi_keluhan : '' }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Apakah hal tersebut melanggar kebijakan keberlanjutan Triputra atau P&C RSPO?</label>
                        <textarea class="form-control" rows="3" name="hal_kebijakan" placeholder="Enter ...">{{ $item ? $item->hal_kebijakan : '' }}
                        </textarea>
                    </div>
                    <div class="form-group" id="img">
                        <label>Bukti</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="bukti">
                        </div>
                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Apakah anda telah melakukan tindakan untuk menyelesaikannya?</label>
                        <select class="form-control select2" name="tindakan" style="width: 100%;">
                            <option value="0" {{ ($item && $item->tindakan == 0) ? 'selected="selected"' : ''}}>Tidak</option>
                            <option value="1" {{ ($item && $item->tindakan == 1) ? 'selected="selected"' : ''}}>Ya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Langkah sementara apakah yang anda ingin untuk PT Triputra Agro Persada lakukan?</label>
                        <textarea class="form-control" rows="3" name="langkah_kebijakan" placeholder="Enter ...">{{ $item ? $item->langkah_kebijakan : '' }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Menurut anda metode apakah yang cocok untuk mengatasi masalah ini?</label>
                        <textarea class="form-control" rows="3" name="metode_masalah" placeholder="Enter ...">{{ $item ? $item->metode_masalah : '' }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hasil seperti apa yang anda inginkan dari keluhan ini?</label>
                        <textarea class="form-control" rows="3" name="hasil_keluhan" placeholder="Enter ...">{{ $item ? $item->hasil_keluhan : '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control select2" name="status" style="width: 100%;">
                            <option value="0" {{ ($item && $item->status == 0) ? 'selected="selected"' : ''}}>Keluhan Baru</option>
                            <option value="1" {{ ($item && $item->status == 1) ? 'selected="selected"' : ''}}>Diproses</option>
                            <option value="2" {{ ($item && $item->status == 2) ? 'selected="selected"' : ''}}>Selesai</option>
                            <option value="3" {{ ($item && $item->status == 3) ? 'selected="selected"' : ''}}>Ditolak</option>
                        </select>
                    </div>
                    <div class="form-group" id="img2">
                        <label>Upload File</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm2" data-input="thumbnail2" data-preview="holder2" class="btn btn-primary text-white">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail2" class="form-control" type="text" name="file_download">
                        </div>
                        <div id="holder2" style="margin-top:15px;max-height:100px;"></div>
                    </div>
                    <div class="form-group">
                        <label>Status File Download</label>
                        <select class="form-control select2" name="is_download" style="width: 100%;">
                            <option value="0" {{ ($item && $item->is_download == 0) ? 'selected="selected"' : ''}}>Tanpa File</option>
                            <option value="1" {{ ($item && $item->is_download == 1) ? 'selected="selected"' : ''}}>Boleh Diunduh</option>
                            <option value="2" {{ ($item && $item->is_download == 2) ? 'selected="selected"' : ''}}>View File</option>
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
                <a href="{{ route('admin.complaint.index') }}" class="btn btn-danger">Cancel</a>
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

        window.open(route_prefix + '?type=file', 'FileManager', 'width=900,height=600');
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
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    bsCustomFileInput.init();

  })
</script>
@endsection