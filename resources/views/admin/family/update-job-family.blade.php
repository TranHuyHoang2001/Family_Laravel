@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Cập nhật tiến độ công việc
            </div>
            <div class="card-body">
                <form action="{{ route('family.complete_job_family',$id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <input required type="file" hidden accept="image/*" onchange="preview_image_1(event)"
                                   class="form-control input-file @error('image_1') is-invalid @enderror" name="image_1"
                                   id="image_1">
                            <label for="image_1" class="btn btn-danger js-labelFile" data-toggle="tooltip"
                                   data-original-title="Hình ảnh 1">
                                <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
                                <span class="js-fileName">Hình ảnh 1</span>
                            </label>
                            <br>
                            <img id="image-pre-1" src="http://via.placeholder.com/120x150" width="120px" height="150px"
                                 style="object-fit: cover; background-color: #fff; padding: 4px; border: 1px solid #ededf0; border-radius: 3px">
                            @error('image_1')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <input required type="file" hidden accept="image/*" onchange="preview_image_2(event)"
                                   class="form-control input-file @error('image_2') is-invalid @enderror" name="image_2"
                                   id="image_2">
                            <label for="image_2" class="btn btn-danger js-labelFile" data-toggle="tooltip"
                                   data-original-title="Hình ảnh 2">
                                <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
                                <span class="js-fileName">Hình ảnh 2</span>
                            </label>
                            <br>
                            <img id="image-pre-2" src="http://via.placeholder.com/120x150" width="120px" height="150px"
                                 style="object-fit: cover; background-color: #fff; padding: 4px; border: 1px solid #ededf0; border-radius: 3px">
                            @error('image_2')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <input required type="file" hidden accept="image/*" onchange="preview_image_3(event)"
                                   class="form-control input-file @error('image') is-invalid @enderror" name="image_3"
                                   id="image_3">
                            <label for="image_3" class="btn btn-danger js-labelFile" data-toggle="tooltip"
                                   data-original-title="Hình ảnh 3">
                                <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
                                <span class="js-fileName">Hình ảnh 3</span>
                            </label>
                            <br>
                            <img id="image-pre-3" src="http://via.placeholder.com/120x150" width="120px" height="150px"
                                 style="object-fit: cover; background-color: #fff; padding: 4px; border: 1px solid #ededf0; border-radius: 3px">
                            @error('image_3')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit"
                            class="btn btn-primary">Hoàn thành công việc
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function preview_image_1(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('image-pre-1');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
        function preview_image_2(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('image-pre-2');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
        function preview_image_3(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('image-pre-3');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
