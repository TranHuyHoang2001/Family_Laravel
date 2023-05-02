
@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            <form action="{{ url('admin/page/store') }}" method="POST" enctype="multipart/form-data" role="form">
                @csrf
                <div class="form-group">
                    <label for="title">Tiêu đề</label>
                    <input class="form-control" type="text" name="title" id="title">  
                        
                </div>
                <div class="form-group">
                    <label for="content">Nội dung</label>
                    <textarea name="content" id="content" class="form-control" cols="30" rows="10"></textarea> 
                
                </div>
                <div class="form-gourp">
                    <label for="file">Hình ảnh trang</label>
                    <input type="file" name="file" class="form-control-file">
                </div>
                <div class="form-group">
                        <label for="">Danh mục</label>
                    <select class="form-control" id="">
                    <option>Chọn danh mục</option>
                    <option>Danh mục 1</option>
                    <option>Danh mục 2</option>
                    <option>Danh mục 3</option>
                    <option>Danh mục 4</option>
                    </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>        
            </form>
          
        </div>
    </div>
</div>
@endsection