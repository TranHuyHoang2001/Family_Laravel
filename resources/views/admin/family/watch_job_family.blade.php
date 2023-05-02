@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Xem lại công việc
            </div>
            <div class="card-body">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="image_1" class="btn btn-danger js-labelFile" data-toggle="tooltip"
                                   data-original-title="Hình ảnh 1">
                                <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
                                <span class="js-fileName">Hình ảnh 1</span>
                            </label>
                            <br>
                            <img id="image-pre-1"
                                 src="{{ isset($job->image_1) ? asset($job->image_1) : 'http://via.placeholder.com/120x150' }}"
                                 width="120px" height="150px" onerror="this.onerror=null;this.src='http://via.placeholder.com/120x150';"
                                 style="object-fit: cover; background-color: #fff; padding: 4px; border: 1px solid #ededf0; border-radius: 3px">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="image_2" class="btn btn-danger js-labelFile" data-toggle="tooltip"
                                   data-original-title="Hình ảnh 2">
                                <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
                                <span class="js-fileName">Hình ảnh 2</span>
                            </label>
                            <br>
                            <img id="image-pre-2"
                                 src="{{ isset($job->image_2) ? asset($job->image_2) : 'http://via.placeholder.com/120x150' }}"
                                 width="120px" height="150px" onerror="this.onerror=null;this.src='http://via.placeholder.com/120x150';"
                                 style="object-fit: cover; background-color: #fff; padding: 4px; border: 1px solid #ededf0; border-radius: 3px">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="image_3" class="btn btn-danger js-labelFile" data-toggle="tooltip"
                                   data-original-title="Hình ảnh 3">
                                <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
                                <span class="js-fileName">Hình ảnh 3</span>
                            </label>
                            <br>
                            <img id="image-pre-3"
                                 src="{{ isset($job->image_3) ? asset($job->image_3) : 'http://via.placeholder.com/120x150' }}"
                                 width="120px" height="150px" onerror="this.onerror=null;this.src='http://via.placeholder.com/120x150';"
                                 style="object-fit: cover; background-color: #fff; padding: 4px; border: 1px solid #ededf0; border-radius: 3px">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
