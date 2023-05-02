@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    @forelse($familyMoment as $val)
    <div class="card">
        <div class="card-header font-weight-bold">
           {{$val->user->first_name ?? 'N/A'}}
            <div style="float: right">
              
                @if(\Cartalyst\Sentinel\Laravel\Facades\Sentinel::getUser()->id == $val->created_by)
                <a href="{{ route('family.family_moment_edit',$val->id) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm rounded-0 text-white" data-toggle="modal" data-target="#delete_confirm" data-url="{{route('family.family_moment_delete', $val->id)}}" title="Xóa"><i class="fa fa-trash"></i></a>
                @endif

           
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="namefamily">{!! $val->content !!}</label>
            </div>
            <div class="form-group">
                <div class="row">
                    @forelse($val->image as $value)
                        <div class="col-sm-4" style="margin-right: 15px">
                            <img class="img-fluid" src="{{asset($value->image)}}" alt="">
                        </div>
                    @empty
                    @endforelse
                </div>

            </div>
        </div>
    </div>
    @empty
        <p>Chưa có khoảnh khắc cho gia đình này!</p>
    @endforelse
    <form action="" id="delete-form" method="post">
            @method('DELETE')
            @csrf
            <div class="modal fade" id="delete_confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xóa khoảnh khắc</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Bạn có chắc chắn muốn xóa khoảnh khắc này không ?
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
