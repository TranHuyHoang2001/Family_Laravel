@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                {{"Cập nhật thông tin công việc"}}
            </div>
            <div class="card-body">
                <form action="{{ route('criteria.update',$criteria->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="namework">Tên tiêu chí</label>
                        <input class="form-control" type="text" name="name" id="name"
                               value="{{ old('name', $criteria->name) }}"
                               placeholder="Tên tiêu chí" required>
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="point">Điều kiện</label>
                        <input class="form-control" type="text" name="proviso" id="point"
                               value="{{ old('proviso', $criteria->proviso ) }}"
                               placeholder="Điều kiện">
                        @error('proviso')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit"
                            class="btn btn-primary">{{ "Cập nhật" }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
