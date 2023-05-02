@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                {{ isset($product) ? "Cập nhật thông tin sản phẩm" : "Thêm mới sản phẩm" }}
            </div>
            <div class="card-body">
                <form action="{{ isset($product) ? route('product.update',$product->id) : route('product.store') }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($product))
                        @method('put')
                    @endif
                    <div class="form-group">
                        <label for="namework">Tên sản phẩm</label>
                        <input class="form-control" type="text" name="name" id="name"
                               value="{{ old('name', isset($product) ? $product->name : '') }}"
                               placeholder="Nhập tên sản phẩm" required>
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea class="form-control" type="text" name="description" id="description"
                                  placeholder="Nhập mô tả">{!! preg_replace('/<br\\s*?\/??>/i', '', old('description', isset($product) ? $product->description : '')) !!}</textarea>
                        @error('detail')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="point">Giá</label>
                        <input class="form-control" type="number" name="price" id="price"
                               value="{{ old('price', isset($product) ? $product->price : '') }}" min="0" step="1"
                               required
                               placeholder="Nhập giá sản phẩm">
                        @error('price')
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
                             src="{{isset($product) ? asset($product->image) : 'http://via.placeholder.com/120x150'}} "
                             width="120px" height="150px"
                             onerror="this.onerror=null;this.src='http://via.placeholder.com/120x150'"
                             style="object-fit: cover; background-color: #fff; padding: 4px; border: 1px solid #ededf0; border-radius: 3px">
                        @error('image')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <button type="submit"
                            class="btn btn-primary">{{ isset($product) ? "Cập nhật" : "Thêm mới" }}</button>
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
