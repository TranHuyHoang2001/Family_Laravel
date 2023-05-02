@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách gia đình</h5>

        </div>
        <div class="card-body">
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Tên gia đình</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($families->total()>0)

                    @foreach ($families as $key=> $family )
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $family->name }}</td>
                            <td>{{ $family->created_at }}</td>
                            <td>
                                <a href="{{ route('family.see_family',$family->id) }}" class="btn btn-warning btn-sm rounded-0 text-white" title="xem"><i class="fas fa-eye"></i></a>
                                @if($family->created_by == Sentinel::getUser()->id)
                                <a href="{{ route('family.edit',$family->id) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm rounded-0 text-white" data-toggle="modal" data-target="#delete_confirm" data-url="{{route('family.delete', $family->id)}}" title="Xóa"><i class="fa fa-trash"></i></a>
                                @endif
                                @if(Sentinel::getUser()->family()->exists() != true && Sentinel::getUser()->memberFamily()->exists() != true)
                                <a data-toggle="modal" data-target="#add-member" data-url="{{route('family.add_member', $family->id)}}" class="btn btn-warning btn-sm rounded-0 text-white" data-placement="top" title="Tham gia"><i class="fas fa-user-plus"></i></a>
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
                {!! $families->links('pagination::bootstrap-4') !!}
            </div>
            <form action="" id="delete-form" method="post">
                @method('DELETE')
                @csrf
                <div class="modal fade" id="delete_confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Xóa gia đình</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Bạn có chắc chắn muốn xóa gia đình này không ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Xóa</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form action="" id="add-member-form" method="post">
                @csrf
                <div class="modal fade" id="add-member" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tham gia gia đình</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">Nhóm quyền</label>
                                    <select name="role_id" class="form-control" id="">
                                        @forelse($roles as $key=>$role)
                                            <option value="{{$key}}">{{$role}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Tham gia</button>
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

        $('#add-member').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var _id = button.data('url');
            $('#add-member-form').attr("action",_id);
        })
    </script>
@endsection
