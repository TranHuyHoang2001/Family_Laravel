@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật người dùng
        </div>
        <div class="card-body">
            <form action="{{ route('user.update',$user->id) }}" method="POST" >
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="first_name" id="name" value="{{ $user->name }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" value="{{ $user->email }}" name="email" id="email" disabled>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="password">
                    @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm">Xác nhận mật khẩu</label>
                    <input class="form-control" type="password" name="password_confirm" id="password-confirm">
                </div>
                <button type="submit" name="btn-add" class="btn btn-primary" value="Thêm mới">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection
