@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                {{ isset($job) ? "Cập nhật thông tin công việc" : "Thêm mới công việc" }}
            </div>
            <div class="card-body">
                <form action="{{ isset($job) ? route('job.update',$job->id) : route('job.store') }}" enctype="multipart/form-data" role="form" method="POST">
                    @csrf
                    @if(isset($job))
                        @method('put')
                    @endif
                    <div class="form-group">
                        <label for="namework">Tên công việc</label>
                        <input class="form-control" type="text" name="name" id="name"
                               value="{{ old('name', isset($job) ? $job->name : '') }}"
                               placeholder="Nhập tên công việc" required>
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-gourp">
                            <label for="content">Hình ảnh công việc</label>
                            <input type="file" name="image" class="form-control-file">
                        </div>                         
                        @error('image')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="point">Điểm hoàn thành</label>
                        <input class="form-control" type="number" name="point" id="point"
                               value="{{ old('point', isset($job) ? $job->point : '') }}" min="0" step="1" required
                               placeholder="Nhập điểm">
                        @error('point')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="">Nhóm quyền</label>
                        <select class="form-control" name="role_id">
                            <option value="">Chọn quyền</option>
                            @if(isset($roles) && count($roles) > 0)
                                @foreach($roles as $key => $role)
                                    <option
                                        @if(old('role_id',isset($job) ? $job->role_id : '') == $key) {{'selected'}} @endif value="{{$key}}">{{$role}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('role_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit"
                            class="btn btn-primary">{{ isset($job) ? "Cập nhật" : "Thêm mới" }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
