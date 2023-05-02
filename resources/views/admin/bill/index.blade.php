@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <section class="content-header pl-3 pt-3 pb-4">
        <h3 class="d-inline-block" >
            Danh sách đơn hàng
        </h3>
        <div class="form-search form-inline float-right">
            <form action="#" class="d-flex">
                <input type="" class="form-control form-search" name="keyword" value="{{ request()->input('keyword')}}" placeholder="Tìm kiếm">
                <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- Main content -->
    <section class="content bg-white">
    @if (Session::has('message'))
        <div class="alert alert-info"> {{ Session::get('message') }}</div>
    @endif
        <!-- Default box -->
        <div class="card-body">
            <div class="box-header with-border">
                <div class="row">
            <div class="col-md-12">
                <table id="myTable" class="table table-striped table-checkall rounded" role="grid" aria-describedby="example2_info">
                    <thead>
                    <tr role="row">
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th class="sorting col-md-1" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="" >STT</th>
                        <th class="sorting_asc col-md-2" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Tên người order</th>
                        <th class="sorting col-md-2" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Địa chỉ</th>
                        <th class="sorting col-md-1" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Ngày đặt hàng</th>
                        <th>Email</th>
                        <th>Trạng thái</th>
                        <th class="sorting col-md-1" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Action</th>
                        <th class="sorting col-md-2" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Xóa</th></tr>
                    </thead>
                    <tbody>
                       @php
                           $t=0;
                       @endphp
                        @foreach($customers as $customer)
                            @php
                                $t++;
                            @endphp                                              
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td>{{ $t }}</td>
                                <td>{{ $customer->fullname }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->created_at }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>Chưa xử lý</td>
                                <td><a href="{{ url('admin/bill')}}/{{ $customer->id }}/edit">Chi tiết</a></td>
                                <td>
                                       <a href="{{ route('bill.delete', $customer->id) }}" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>                                                                   
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            </div>
        </div>
    </section>
</div>
@endsection
