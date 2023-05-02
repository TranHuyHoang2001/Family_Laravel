@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                "Thêm mới tiêu chí"
            </div>
            <div class="card-body">
                <form action="{{ route('criteria.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="namework">Tên tiêu chí</label>
                        <input class="form-control" type="text" name="name" id="name"
                               value="{{ old('name')}}"
                               placeholder="Tên tiêu chí" required>
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="point">Điều kiện</label>
                        <input class="form-control" type="text" name="proviso" id="point"
                               value="{{ old('proviso') }}" min="0"
                               placeholder="Điều kiện">
                        @error('proviso')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit"
                            class="btn btn-primary">{{ "Thêm mới" }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
