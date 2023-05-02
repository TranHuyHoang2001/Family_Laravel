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
            <h5 class="m-0 ">Danh sách thành viên</h5>
            <div class="form-search form-inline float-right">
                <form action="#" class="d-flex">
                    <input type="" class="form-control form-search" name="keyword" value="{{ request()->input('keyword')}}" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-checkall">

                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Quyền</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->total()>0)
                    @php
                    $t=0;
                @endphp
                @foreach ($users as $user )
                @php
                  $t++;
                @endphp
                <tr>
                    <td>
                        <input type="checkbox" name="list_check[]" value="{{ $user->id }}">
                    </td>
                    <th scope="row">{{ $t }}</th>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{$user->roles()->first() ? $user->roles()->first()->name : 'N/A'}}</td>
                    <td>{{$user->created_at }}</td>
                    <td>
                        @php 
                            $role = Sentinel::getUser()->roles()->first() ? Sentinel::getUser()->roles()->first()->id : null;
                        @endphp
                        @if (in_array($role, [1,2,3]))
                            <a href="{{ route('user.edit',$user->id) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            @if ( Sentinel::getUser()->id!=$user->id)
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm rounded-0 text-white" data-toggle="modal" data-target="#delete_confirm" data-url="{{route('user.delete', $user->id)}}" title="Delete"><i class="fa fa-trash"></i></a>
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
                <div class="example-box-wrapper pagination mt-3">
                    {!! $users->links('pagination::bootstrap-4') !!}
                </div>
                <form action="" id="delete-form" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal fade" id="delete_confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Xóa tài khoản</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Bạn có chắc chắn muốn xóa tài khoản này không ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Xóa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

        </div>


    </div>
</div>
@stop
@section('script')
    <script>
        var url_path = '{!! url('/') !!}';
        $('#delete_confirm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var _id = button.data('url');
            $('#delete-form').attr("action",_id);
        })
    </script>
@endsection
