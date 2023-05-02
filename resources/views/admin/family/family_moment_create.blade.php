@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
           Thêm khoảnh khắc
        </div>
        <div class="card-body">
            <form action="{{ route('family.family_moment_store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="namefamily">Nội dung</label>
                    <textarea class="form-control" type="text" name="content" id="namefamily" placeholder="Nhập nội dung"></textarea>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="">Hình ảnh</label>
                    <input type="file" class="form-control" name="image[]" multiple>
                </div>

                <button type="submit" class="btn btn-primary" value="Thêm mới">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection
