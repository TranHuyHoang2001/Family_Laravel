@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                {{ isset($honors) ? "Cập nhật thông tin vinh danh gia đình" : "Thêm mới vinh danh gia đình" }}
            </div>
            <div class="card-body">
                <form action="{{ isset($honors) ? route('honors.update',$honors->id) : route('honors.store') }}"
                      method="POST">
                    @csrf
                    @if(isset($honors))
                        @method('put')
                    @endif

                    <div class="form-group">
                        <label for="namework">Gia đình</label>
                        <select class="form-control" name="family_id">
                            @if(isset($families) && count($families) > 0)
                                @foreach($families as $key => $family)
                                    <option
                                        {{ old('family_id', isset($honors) ? $honors->family_id : '' ) == $key ? 'selected' : '' }} value="{{ $key }}">{{ $family }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('family_id')
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
                            class="btn btn-primary">{{ isset($job) ? "Cập nhật" : "Thêm mới" }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
