@extends('layouts.app')
@section('title', 'إضافة فرع جديد')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-plus-circle me-1"></i> إضافة فرع جديد
    </div>

    <div class="card-body">
        <form action="{{ route('stores.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">اسم الفرع <span class="text-danger">*</span></label>
                    <input type="text" name="store_name" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">المدينة <span class="text-danger">*</span></label>
                    <input type="text" name="city" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">العنوان <span class="text-danger">*</span></label>
                    <input type="text" name="address" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">الهاتف <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">ملف البروشور (اختياري)</label>
                    <input type="file" name="upload_file" class="form-control">
                </div>

            </div>

            <button type="submit" class="btn btn-primary rounded-pill">
                <i class="fas fa-save me-1"></i> حفظ
            </button>

            <a href="{{ route('stores.index') }}" class="btn btn-outline-secondary rounded-pill">
                إلغاء
            </a>

        </form>
    </div>
</div>
@endsection
