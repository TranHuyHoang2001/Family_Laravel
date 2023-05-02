
@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm kinh nghiệm
        </div>
        <div class="card-body">
            <form action="{{ route('experience.store') }}" method="POST" enctype="multipart/form-data" role="form">
                @csrf
                <div class="form-group">
                    <label for="title">Tiêu đề</label>
                    <input class="form-control" type="text" name="name" id="title">

                </div>
                <div class="form-group">
                    <label for="content">Nội dung</label>
                    <textarea name="content" id="content" class="form-control" cols="30" rows="10"></textarea>

                </div>
                <div class="form-gourp">
                    <label for="content">Hình ảnh bài viết</label>
                    <input type="file" name="image" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" id="" name="category_id">
                        @forelse($category as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                        @empty
                        @endforelse
                    </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection
