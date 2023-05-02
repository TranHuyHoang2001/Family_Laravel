@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        @if (session('status'))
    <div class="alert alert-success">
        {{ session('status')}}
    </div>
        
    @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Trang giới thiệu</h5>
            <div class="form-search form-inline">
                <form action="#" class="d-flex">
                    <input type="" class="form-control form-search" name="keyword" value="{{ request()->input('keyword')}}" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="" class="text-primary">Trạng thái 1<span class="text-muted">(10)</span></a>
                <a href="" class="text-primary">Trạng thái 2<span class="text-muted">(5)</span></a>
                <a href="" class="text-primary">Trạng thái 3<span class="text-muted">(20)</span></a>
            </div>
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="">
                    <option>Chọn</option>
                    <option>Tác vụ 1</option>
                    <option>Tác vụ 2</option>
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Nội dung</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>

                   @foreach ($page as $page)
                       
                  
                       <tr>
                        <td>
                            <input type="checkbox">
                        </td>
                        <td scope="row">1</td>
                        <td width='180' class="p-0"> <img src="{{asset($page->thumbnail) }}" alt="" class="img-fluid w-75 h-25"></td>
                        <td><a href="">{{ $page->title }}</a></td>
                        <td>{{ $page->content }}</td>
                        <td>{{ $page->created_at }}</td>
                        <td>
                            <a href="{{ route('page.edit',$page->id) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                        
                                <a href="{{ route('delete_page',$page->id) }}" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a> 
                           
                        </td>

                    </tr>  
                     @endforeach
                </tbody>
            </table>
         
        </div>
    </div>
</div>
@endsection