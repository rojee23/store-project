@extends('layouts.app')
@section('title', 'إضافة محافظة جديدة')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-plus-circle me-1"></i> إضافة محافظة جديدة
    </div>

    <div class="card-body">
        <form action="{{ route('provinces.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="province_name" class="form-label">اسم المحافظة <span class="text-danger">*</span></label>
                <input type="text"
                       name="province_name"
                       id="province_name"
                       class="form-control"
                       value="{{ old('province_name') }}"
                       required>

                @error('province_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary rounded-pill">
                <i class="fas fa-save me-1"></i> حفظ
            </button>

            <a href="{{ route('provinces.index') }}" class="btn btn-outline-secondary rounded-pill">
                إلغاء
            </a>
        </form>
    </div>
</div>
@endsection
