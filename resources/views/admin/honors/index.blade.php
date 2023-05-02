@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách vinh danh</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-checkall">
                    <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Tên gia đình/cá nhân</th>
                        <th scope="col">Tiêu chí</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($honors && count($honors) > 0)
                        @foreach ($honors as $key => $val )
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td scope="row">{{ $key + 1 }}</td>
                                @if(isset($val->user))
                                    <td>{{ $val->user->first_name }}</td>
                                @elseif(isset($val->family))
                                    <td>{{ $val->family->name }}</td>
                                @endif
                                <td>{{ isset($val->criteria) ? $val->criteria->name : '' }}</td>
                                <td>{{ $val->created_at }}</td>
                                <td>
                                    @php 
                                    $role = Sentinel::getUser()->roles()->first() ? Sentinel::getUser()->roles()->first()->id : null;
                                    @endphp
                                    @if (in_array($role, [1,2,3]))
                                       
                                        @if ( Sentinel::getUser()->id!=$val->id)
                                        <a href="javascript:void(0)"
                                        class="btn btn-danger btn-sm rounded-0 text-white"
                                        data-toggle="modal" data-target="#delete_confirm"
                                        data-route="{{route('honors.delete', $val->id)}}" title="Delete"><i
                                             class="fa fa-trash"></i></a>
                                     </td>
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
                    {!! $honors->links('pagination::bootstrap-4') !!}
                </div>
                <form action="" id="delete-form" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal fade" id="delete_confirm" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Xóa vinh danh</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Bạn có chắc chắn muốn xoá vinh danh này không ?
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
@endsection
@section('script')
    <script>
        $('#delete_confirm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var url = button.data('route');
            $('#delete-form').attr("action", url);
        });
    </script>
@endsection
