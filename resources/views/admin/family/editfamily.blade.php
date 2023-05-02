@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật gia đình
        </div>
        <div class="card-body">
            <form action="{{ route('family.update',$family->id) }}" method="POST" >
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="namefamily">Tên gia đình</label>
                    <input class="form-control" type="text" name="name" id="namefamily" value="{{ $family->name }}">
                </div>

                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select class="form-control" id="">
                        @forelse($roles as $key=>$value)
                            <option @if($key == $family->role_id) selected @endif value="{{$key}}">{{$value}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
            </form>
            <h3 class="mt-3">Thành viên</h3>
            <div class="form-group row">
                <label class="col-sm-2" for="namefamily">STT</label>
                <label class="col-sm-2" for="namefamily">Tên thành viên</label>
                <label class="col-sm-2" for="namefamily">Quyền</label>
                <label class="col-sm-2" for="namefamily">Điểm</label>
                <label class="col-sm-2">Trạng thái</label>
                <label class="col-sm-2">Hành động</label>
            </div>
            @forelse($family->member as $key => $member)
                <div class="form-group row">
                    <label class="col-sm-2" for="namefamily">{{$key+1}}</label>
                    <label class="col-sm-2" for="namefamily">{{$member->user->first_name}}</label>
                    <label class="col-sm-2" for="namefamily">  <td>{{$member->user->roles()->first() ? $member->user->roles()->first()->name : 'N/A'}}</td></label>
                    <label class="col-sm-2" for="namefamily">{{$member->user->point}}</label>
                    <label class="col-sm-2">{!! $member->getStatus() !!}</label>
                    <div class="col-sm-2">
                       
                        @if(in_array($member->user->roles()->first()->id,[1,2,3,4]))
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm rounded-0 text-white" data-toggle="modal" data-target="#delete_confirm" data-id="{{$member->id}}" title="Xóa"><i class="fa fa-trash"></i></a>
                        @endif
                        @if($member->status == 2)
                        <a href="{{route('family.accept_member', $member->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" title="Khóa"><i class="fa fa-lock"></i></a>
                        @else
                        <a href="{{route('family.accept_member', $member->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" title="Duyệt"><i class="fa fa-unlock"></i></a>
                        @endif
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        <form action="" id="delete-form" method="post">
            @method('DELETE')
            @csrf
            <div class="modal fade" id="delete_confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xóa thành viên</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Bạn có chắc chắn muốn xóa thành viên này không ?
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
@stop
@section('script')
    <script>
        var url_path = '{!! url('/') !!}';
        $('#delete_confirm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var _id = button.data('id');
            $('#delete-form').attr("action",url_path+"/family/delete-member/"+_id);
        })
    </script>
@endsection
