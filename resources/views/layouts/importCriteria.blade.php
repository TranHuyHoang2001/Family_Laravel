@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Import
        </div>
        <div class="card-body">
            <form action="{{ route('post_import_criteria') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">File Excel</label>
                    <input class="form-control" type="file" name="file" id="name">
                    @error('first_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" name="btn-add" class="btn btn-primary" value="Thêm mới">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection
