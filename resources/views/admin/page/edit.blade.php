
@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
           Sửa trang
        </div>
        <div class="card-body">
            <form action="{{ route('page.update',$page->id) }}" method="POST" role='form' enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Tiêu đề</label>
                    <input class="form-control" type="text" name="title" id="title" value="{{ $page->title }}">  
                        
                </div>
                <div class="form-group">
                    <label for="content">Nội dung</label>
                    <textarea name="content" id="content" class="form-control" cols="30" rows="10">{{ $page->content }}</textarea> 
                
                </div>
                <div class="form-gourp">
                    <label for="content">Hình ảnh bài viết</label>
                    <input type="file" name="file" class="form-control-file">
                </div>
               
                    <button type="submit" class="btn btn-primary">Thêm mới</button>        
            </form>
        </div>
    </div>
</div>
@endsection