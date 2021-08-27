@extends('backend.layout.master')

@section('title', 'Create News')

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/croppie.css') }}">
@endpush

@section('content')

    <section class="content-header">
        <h1>
            Create News
            <small><a href="{{ route('admin.news.index') }}" class="btn btn-block btn-xs btn-warning btn-flat"><i class="fa fa-plus"></i> BACK</a></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">General Elements</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" role="form">
                @csrf
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="newstitle">News Author</label>
                                <input type="text" name="author" class="form-control" id="newsauthor" value="{{old('author')}}">
                            </div>
                            <div class="form-group">
                                <label for="newstitle">News Title</label>
                                <input type="text" name="title" class="form-control" id="newstitle" value="{{old('title')}}">
                            </div>
                            <div class="form-group">
                                <label for="newstitle">Language</label>
                                <select name="language" class="form-control select2" style="width: 100%;">
                                    @if (old('language'))
                                        <option value="{{old('language')}}" selected>{{ old('language') }}</option>
                                    @endif
                                    <option value="">Language</option>
                                    <option value="English">English</option>
                                    <option value="Hausa">Hausa</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Categories</label>
                                <select name="category_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Categories</option>
                                    @foreach($categories as $category)
                                        <option {{old('category_id') == $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>News Details</label>
                                <textarea class="wysi" name="details" placeholder="Place some text here"
                                style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                >{{old('details')}}</textarea>
                            </div>
                            <div id="cropedimage" style="max-height: 200px; max-width: 200px;"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="newsimage">Featured Image</label>
                                <input type="file" name="image" id="newsimage">
                                <p class="help-block">(Image must be in .png or .jpg format)</p>
                                <div id="images">
                                </div>
                            </div>
                            <hr>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="status" {{old('status') ? 'checked' : ''}}> Published
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="featured" {{old('featured') ? 'checked' : ''}}> Featured
                                </label>
                            </div>
                        </div>

                        <input type="hidden" name="imagename" id="imagebit">
                        <div class="box-footer">
                            {{-- <button class="btn btn-info btn-flat margin-r-5" id="uploadimage">Upload Image</button> --}}
                            <button type="submit" class="btn btn-primary btn-flat" id="postnews">POST NEWS</button>
                        </div>
                    </div>
                </div>
            </form>
            <form>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="newsimage">News Image</label>
                                <input type="file" name="image" id="newsimage">
                                <p class="help-block">(Image must be in .png or .jpg format)</p>
                                <div id="images">
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="col-12">
                            <table class="table table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <th>Link</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                </div>
            </form>

        </div>
    </section>
@endsection

@push('scripts')
    <!-- iCheck -->
    <script src="{{ asset('backend/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('backend/components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/croppie.js') }}"></script>
    {{-- <script src="{{ asset('backend/plugins/bootstrap-wysihtml5/underscore.js') }}"></script>
    <script src="{{ asset('backend/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5-0.0.2.js') }}"></script>
    <script src="{{ asset('backend/plugins/bootstrap-wysihtml5/custom_image_and_upload_wysihtml5.js') }}"></script>
    <script src="{{ asset('backend/plugins/bootstrap-wysihtml5/jqueryupload.js') }}"></script> --}}
    <script>
        $(function () {

            $('.select2').select2();

            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue'
            });

            $('.wysi').wysihtml5();

            $('.wysi').contents().find('body').on("drop", function(event) {
              event.preventDefault();
              event.stopPropagation();
               var dt = event.originalEvent.dataTransfer;
                        var files = dt.files;

              var reader = new FileReader();
              reader.onload = function (e) {
                    debugger;
                  var data = this.result;
                  vm.composer.commands.exec('insertImage',e.target.result);
              }
              reader.readAsDataURL( files[0] );
          });

        });
       try {
$(document).ready(function(){
    // var uploadImageButton = document.getElementById('uploadimage');
    var postNewsButton = document.getElementById('postnews');
  $('#newsimage').change(function(){

    $image_crop = $('#images').croppie({
    // enableExif:true,
    viewport:{
      width: 400,
      height:300,
    //   type:'circle'
    },
    boundary:{
      width:600,
      height:400
    }
  });
    var reader = new FileReader();

    reader.onload = function(event){
      $image_crop.croppie('bind', {
        url:event.target.result
      }).then(function(){
        // uploadImageButton.classList.toggle('hidden');
        $image_crop.croppie('result', {
        type:'canvas',
        size:'viewport'
        }).then(function(response) {
            $('#imagebit').val(response);
        });
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#images').on('update.croppie', function(ev) {
        $image_crop.croppie('result', {
        type:'canvas',
        size:'viewport'
        }).then(function(response) {
            $('#imagebit').val(response);
        });
    });
  });

//   document.getElementById('another-croppie').addEventListener('update', function(ev) { var cropData = ev.detail; });

//   $('#uploadimage').click(function(event){
//     event.preventDefault();
//     $image_crop.croppie('result', {
//       type:'canvas',
//       size:'viewport'
//     }).then(function(response){
//         // $('#newsimage').val(response);
//       var _token = $('input[name=_token]').val();
//       $.ajax({
//         url:'{{ route("image_crop.upload") }}',
//         type:'post',
//         data:{"image":response, _token:_token},
//         dataType:"json",
//         success:function(data)
//         {
//           var crop_image = '<img style="width:300px; height:200px;" src="/'+data.path+'" />';
//           $('#cropedimage').html(crop_image);
//         //   $('#imagename').val(data.path);
//         //   uploadImageButton.classList.toggle('hidden');
//         //   postNewsButton.classList.toggle('hidden');
//         }
//       });
//     });
//   });

});
       } catch (error) {
           console.log(error);
       }
    </script>
@endpush
