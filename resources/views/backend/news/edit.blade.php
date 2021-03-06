@extends('backend.layout.master')

@section('title', 'Edit News')

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/croppie.css') }}">
@endpush

@section('content')

    <section class="content-header">
        <h1>
            Edit News
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

            <form action="{{ route('admin.news.update',$news->id) }}" method="POST" enctype="multipart/form-data" role="form">
                @csrf
                @method('PUT')

                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="newstitle">News Author</label>
                                <input type="text" name="author" class="form-control" id="newsauthor" value="{{$news->author}}">
                            </div>
                            <div class="form-group">
                                <label for="newstitle">News Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $news->title }}" id="newstitle">
                            </div>
                            <div class="form-group">
                                <label for="newstitle">Language</label>
                                <select name="language" class="form-control select2" style="width: 100%;">
                                    <option value="" disabled selected>Language</option>
                                    <option value="English">English</option>
                                    <option value="Hausa">Hausa</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Categories</label>
                                <select name="category_id" class="form-control select2" style="width: 100%;">
                                    <option value="" disabled selected>Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if($category->id == $news->category_id) {{'selected'}} @endif)>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>News Details</label>
                                <textarea class="textarea" name="details" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                    {{ $news->details }}
                                </textarea>
                            </div>
                            <div class="box-body">
                                <img src="{{ asset('images/news/'.$news->image) }}" alt="{{ $news->title }}" class="img-responsive img-fluid">
                            </div>
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
                            </div>
                            <hr>
                            <div id="images">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="status" {{ $news->status ? 'checked' : '' }}> Published
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="featured" {{ $news->featured ? 'checked' : '' }}> Featured
                                </label>
                            </div>
                        </div>
                        {{-- <input type="hidden" name="edit_imagename" id="editimagebit"> --}}
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-flat">UPDATE</button>
                        </div>
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
    <script>
        $(function () {

            $('.select2').select2();

            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue'
            });

            $('.textarea').wysihtml5();
        });

        $(document).ready(function() {
            $('#newsimage').change(function(){
                $image_crop_edit = $('#images').croppie({
                    enableExif:true,
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

                var readerEdit = new FileReader();

                readerEdit.onload = function(event){
                $image_crop_edit.croppie('bind', {
                    url:event.target.result
                }).then(function(){
                    // uploadImageButton.classList.toggle('hidden');
                    $image_crop_edit.croppie('result', {
                    type:'canvas',
                    size:'viewport'
                    }).then(function(response) {
                        $('#editimagebit').val(response);
                    });
                });
                }
                readerEdit.readAsDataURL(this.files[0]);
                $('#images').on('update.croppie', function(ev) {
                    $image_crop_edit.croppie('result', {
                    type:'canvas',
                    size:'viewport'
                    }).then(function(response) {
                        $('#editimagebit').val(response);
                    });
                });
            });
        });
</script>
@endpush
