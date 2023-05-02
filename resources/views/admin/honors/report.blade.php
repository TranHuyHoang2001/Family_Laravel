@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    @forelse($families as $key=>$family)
        @php
            $point = 0;
            if (isset($family->job))
            {
                foreach ($family->job as $val)
                {
                    if ($val->job)
                    {
                            $point += $val->job->point;
                    }
                }
            }

        @endphp
    <div class="card" style="margin-bottom: 20px">
        <div class="card-header font-weight-bold">
            Gia đình : {{$family->name}}
            <div style="float: right">
                Điểm : {{$point}}
            </div>
        </div>


        <div class="card-body">
            <h3 class="mt-3">Thành viên</h3>
            <div class="form-group row">
                <label class="col-sm-2" for="namefamily">STT</label>
                <label class="col-sm-2" for="namefamily">Tên thành viên</label>
                <label class="col-sm-2" for="namefamily">Điểm</label>
            </div>
            @forelse($family->member as $key => $member)
                <div class="form-group row">
                    <label class="col-sm-2" for="namefamily">{{$key+1}}</label>
                    <label class="col-sm-2" for="namefamily">{{$member->user->first_name}}</label>
                    <label class="col-sm-2" for="namefamily">{{$member->user->point}}</label>
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
    @empty
    @endforelse
</div>
@stop

