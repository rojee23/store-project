@extends('layouts.app')
@section('title', 'تعديل محافظة')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-warning text-dark">
        <i class="fas fa-edit me-1"></i> تعديل محافظة
    </div>

    <div class="card-body">
        <form action="{{ route('provinces.update', $province->province_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="province_name" class="form-label">
                    اسم المحافظة <span class="text-danger">*</span>
                </label>

                <input type="text"
                       name="province_name"
                       id="province_name"
                       class="form-control"
                       value="{{ old('province_name', $province->province_name) }}"
                       required>

                @error('province_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary rounded-pill">
                <i class="fas fa-save me-1"></i> تحديث
            </button>

            <a href="{{ route('provinces.index') }}" class="btn btn-outline-secondary rounded-pill">
                إلغاء
            </a>
        </form>
    </div>
</div>
@endsection
