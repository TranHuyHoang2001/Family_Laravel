@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
           Thêm gia đình
        </div>
        <div class="card-body">
            <form action="{{ route('family.store') }}" method="POST" >
                @csrf
                <div class="form-group">
                    <label for="namefamily">Tên gia đình</label>
                    <input class="form-control" type="text" name="name" id="namefamily" value="{{old('name')}}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                


                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select name="role_id" class="form-control" id="">
                        @forelse($roles as $key=>$value)
                            <option value="{{$key}}">{{$value}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>

                <button type="submit" class="btn btn-primary" value="Thêm mới">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection
