@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                @if(isset($introduce))
                    Cập nhật giới thiệu gia đình
                @else
                    Thêm mới giới thiệu gia đình
                @endif
            </div>
            <div class="card-body">
                <form
                    action="{{ isset($introduce) ? route('introduce_family.update', $introduce->id) : route('introduce_family.store')}}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <input class="form-control" type="text" name="description" id="description"
                               placeholder="Nhập mô tả"
                               value="{{ old('description', isset($introduce) ? $introduce->description : '') }}">
                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="detail">Nội dung</label>
                        <textarea class="form-control" type="text" name="detail" id="detail"
                                  placeholder="Nhập nội dung">{!! preg_replace('/<br\\s*?\/??>/i', '', old('detail', isset($introduce) ? $introduce->detail : '')) !!}</textarea>
                        @error('detail')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="file" hidden accept="image/*" onchange="preview_image(event)"
                               class="form-control input-file @error('image') is-invalid @enderror" name="image"
                               id="image">
                        <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip"
                               data-original-title="Hình ảnh">
                            <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
                            <span class="js-fileName">Hình ảnh</span>
                        </label>
                        <br>
                        <img id="image-pre"
                             src="{{isset($introduce) ? asset($introduce->image) : 'http://via.placeholder.com/120x150'}} "
                             width="120px" height="150px"
                             onerror="this.onerror=null;this.src='http://via.placeholder.com/120x150'"
                             style="object-fit: cover; background-color: #fff; padding: 4px; border: 1px solid #ededf0; border-radius: 3px">
                        @error('image')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        @if(isset($introduce))
                            Cập nhật
                        @else
                            Thêm mới
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function preview_image(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('image-pre');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
