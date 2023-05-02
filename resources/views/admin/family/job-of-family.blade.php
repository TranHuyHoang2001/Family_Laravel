@extends('layouts.admin')
@section('content')

    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách công việc</h5>
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
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Tên công việc</th>
                        <th scope="col">Điểm hoàn thành</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Người làm</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($jobs && count($jobs) > 0)
                        @foreach ($jobs as $key => $job)
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td scope="row">{{ $key + 1 }}</td>
                                <td>{{ $job->job ?  $job->job->name : '' }}</td>
                                <td>{{ $job->job ?  $job->job->point : '' }}</td>
                                @switch($job->status)
                                    @case(\App\Models\JobFamily::DONOT)
                                    <td><span class="badge bg-warning text-dark">Chưa thực hiện</span></td>
                                    @break
                                    @case(\App\Models\JobFamily::RECEIVED)
                                    <td><span class="badge bg-primary">Đang thực hiện</span></td>
                                    @break
                                    @case(\App\Models\JobFamily::COMPLETE)
                                    <td><span class="badge bg-success">Hoàn thành</span></td>
                                    @break
                                @endswitch
                                <td>{{ $job->user ? $job->user->first_name : '' }}</td>
                                <td>{{ $job->created_at }}</td>
                                <td>
                                @php
                                    $role = \Cartalyst\Sentinel\Laravel\Facades\Sentinel::getUser()->roles()->first();
                                    $role_user = $role->id;
                                    $role = $job->job ? $job->job->role_id : 0;
                                @endphp
                                @if(in_array($role_user,[1,$role]) || in_array($role,[0,null]))
                                    <!--
                                    Check quyền
                                    TH1: Tk admin
                                    TH2: Tk có quyền tương ứng
                                    TH3: Công việc ko add quyền
                                    -->
                                        @switch($job->status)
                                            @case(\App\Models\JobFamily::DONOT)
                                            <a href="javascript:void(0)"
                                               class="btn btn-warning btn-sm rounded-0 text-white"
                                               data-toggle="modal" data-target="#get_job_confirm"
                                               data-route="{{ route('family.get_job',$job->id) }}"
                                               title="Nhận công việc"><i
                                                    class="fa fa-download"></i></a>
                                            @break
                                            @case(\App\Models\JobFamily::RECEIVED)
                                            <a href="{{ route('family.update_job_family',$job->id) }}"
                                               class="btn btn-info btn-sm rounded-0 text-white" type="button"
                                               data-toggle="tooltip" data-placement="top" title="Hoàn thành"><i
                                                    class="fa fa-clock"></i></a>
                                            @break
                                            @case(\App\Models\JobFamily::COMPLETE)
                                            <a href="{{route('family.watch_job_family', $job->id)}}"
                                               class="btn btn-info btn-sm rounded-0 text-white" title="Xem lại"><i
                                                    class="fa fa-eye"></i></a>
                                            @break
                                        @endswitch
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
                    {!! $jobs->links('pagination::bootstrap-4') !!}
                </div>
                <form action="" id="delete-form" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal fade" id="delete_confirm" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Xóa tiêu chí</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Bạn có chắc chắn muốn xoá công việc này không ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Xóa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="" id="get-job-form" method="post">
                    @csrf
                    <div class="modal fade" id="get_job_confirm" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Nhận công việc</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Bạn có chắc chắn muốn nhận công việc này không ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Nhận</button>
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
        $('#get_job_confirm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var url = button.data('route');
            $('#get-job-form').attr("action", url);
        });
        $('#delete_confirm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var url = button.data('route');
            $('#delete-form').attr("action", url);
        });
    </script>
@endsection
