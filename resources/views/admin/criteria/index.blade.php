@extends('layouts.admin')
@section('content')

    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách tiêu chí</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-checkall">
                    <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Tên tiêu chí</th>
                        <th scope="col">Điều kiện</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($criterias && count($criterias) > 0)
                        @foreach ($criterias as $key => $criteria )
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td scope="row">{{ $key + 1 }}</td>
                                <td>{{ $criteria->name }}</td>
                                <td>{{ $criteria->proviso }}</td>
                                <td>
                                    <a href="{{ route('criteria.edit',$criteria->id) }}"
                                       class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                       data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fa fa-edit"></i></a>

                                    <a href="javascript:void(0)"
                                       class="btn btn-danger btn-sm rounded-0 text-white"
                                       data-toggle="modal" data-target="#delete_confirm" data-url="{{route('criteria.delete', $criteria->id)}}" title="Delete"><i
                                            class="fa fa-trash"></i></a>
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
                    {!! $criterias->links('pagination::bootstrap-4') !!}
                </div>
                <!-- Modal -->
                <form action="" id="delete-form" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal fade" id="delete_confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Xóa tiêu chí</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Bạn có chắc chắn muốn xóa tiêu chí này không ?
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
