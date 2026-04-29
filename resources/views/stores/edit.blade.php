@extends('layouts.app')
@section('title', 'تعديل فرع')

@section('content')

{{-- عرض رسائل الأخطاء --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>حدثت أخطاء في الإدخال:</strong>
        <ul class="mt-2 mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-header bg-warning text-dark">
        <i class="fas fa-edit me-1"></i> تعديل فرع
    </div>

    <div class="card-body">
        <form action="{{ route('stores.update', $store->store_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">اسم الفرع <span class="text-danger">*</span></label>
                    <input type="text"
                           name="store_name"
                           class="form-control"
                           value="{{ old('store_name', $store->store_name) }}"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">المدينة <span class="text-danger">*</span></label>
                    <input type="text"
                           name="city"
                           class="form-control"
                           value="{{ old('city', $store->city) }}"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">العنوان <span class="text-danger">*</span></label>
                    <input type="text"
                           name="address"
                           class="form-control"
                           value="{{ old('address', $store->address) }}"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">الهاتف <span class="text-danger">*</span></label>
                    <input type="text"
                           name="phone"
                           class="form-control"
                           value="{{ old('phone', $store->phone) }}"
                           required>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">ملف البروشور (اختياري)</label>
                    <input type="file" name="upload_file" class="form-control">

                    @if($store->upload_file)
                        <div class="mt-2">
                            <a href="{{ asset('uploads/' . $store->upload_file) }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-file-download me-1"></i> تنزيل البروشور الحالي
                            </a>
                        </div>
                    @endif
                </div>

            </div>

            <button type="submit" class="btn btn-primary rounded-pill">
                <i class="fas fa-sync-alt me-1"></i> تحديث
            </button>

            <a href="{{ route('stores.index') }}" class="btn btn-outline-secondary rounded-pill">
                إلغاء
            </a>

        </form>
    </div>
</div>

@endsection
