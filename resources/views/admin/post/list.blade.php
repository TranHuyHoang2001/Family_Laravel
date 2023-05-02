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
            <h5 class="m-0 ">Danh sách bài viết</h5>
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
                    @if ($posts->total()>0)
                    @php
                    $t=0;
                    @endphp
                    @foreach ($posts as $post )
                    @php
                    $t++;   
                    @endphp
                       <tr>
                        <td>
                            <input type="checkbox">
                        </td>
                        <td scope="row">{{ $t }}</td>
                        <td width='150'><img src="{{asset($post->thumbnail)}}" class="w-100 h-100" alt=""></td>
                        <td><a href="">{{ $post->title }}</a></td>
                        <td>{{ $post->content }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>
                            @php 
                            $role = Sentinel::getUser()->roles()->first() ? Sentinel::getUser()->roles()->first()->id : null;
                            @endphp
                            @if (in_array($role, [1,2,3]))
                                <a href="{{ route('post.edit',$post->id) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                @if ( Sentinel::getUser()->id!=$user->id)
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm rounded-0 text-white" data-toggle="modal" data-target="#delete_confirm" data-url="{{route('post.delete', $post->id)}}" title="Delete"><i class="fa fa-trash"></i></a>
                                @endif
                            @endif
                            </td>

                    </tr>  
                    @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="bg-white"><p>Không tìm thấy bản ghi</p></td>
                        </tr>
                    @endif
                   

                </tbody>
            </table>
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection