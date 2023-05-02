@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                {{ isset($honors) ? "Cập nhật vinh danh cá nhân" : "Thêm mới vinh danh cá nhân" }}
            </div>
            <div class="card-body">
                <form action="{{ isset($honors) ? route('honors.update',$honors->id) : route('honors.store') }}"
                      method="POST">
                    @csrf
                    @if(isset($honors))
                        @method('put')
                    @endif
                    <div class="form-group">
                        <label for="namework">Cá nhân</label>
                        <select class="form-control" name="user_id">
                            @if(isset($users) && count($users) > 0)
                                @foreach($users as $key => $user)
                                    <option
                                        {{ old('user_id', isset($honors) ? $honors->user_id : '' ) == $key ? 'selected' : '' }} value="{{ $key }}">{{ $user }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('user_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="namework">Tiêu chí</label>
                        <select class="form-control" name="criteria_id">
                            @if(isset($criterias) && count($criterias) > 0)
                                @foreach($criterias as $key => $criteria)
                                    <option
                                        {{ old('criteria_id', isset($honors) ? $honors->criteria_id : '' ) == $key ? 'selected' : '' }} value="{{ $key }}">{{ $criteria }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('criteria_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit"
                            class="btn btn-primary">{{ isset($honors) ? "Cập nhật" : "Thêm mới" }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
