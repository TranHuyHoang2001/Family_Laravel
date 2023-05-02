@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
           Chỉnh sửa khoảnh khắc
        </div>
        <div class="card-body">
            <form action="{{ route('family.family_moment_update', $familyMoment->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="namefamily">Nội dung</label>
                    <textarea class="form-control" type="text" name="content" id="namefamily" placeholder="Nhập nội dung">{!! preg_replace('/<br\\s*?\/??>/i', '', $familyMoment->content) !!}</textarea>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="">Hình ảnh</label>
                    <input type="file" class="form-control" name="image[]" multiple>
                </div>
                <div class="form-group">
                    <div class="row">
                        @forelse($familyMoment->image as $value)
                            <div class="col-sm-4" style="margin-right: 15px">
                                <img class="img-fluid" src="{{asset('storage/'.$value->image)}}" alt="">
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" value="Thêm mới">Chỉnh sửa</button>
            </form>
        </div>
    </div>
</div>
@endsection
