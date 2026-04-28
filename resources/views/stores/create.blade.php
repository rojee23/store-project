@extends('layouts.app')
@section('title', 'إضافة فرع جديد')

@section('content')
<h2>إضافة فرع جديد</h2>
<form action="{{ route('stores.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>اسم الفرع</label>
        <input type="text" name="store_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>المحافظة</label>
        <select name="province_id" class="form-control" required>
            <option value="">اختر المحافظة</option>
            @foreach(\App\Models\Province::all() as $province)
                <option value="{{ $province->id }}">{{ $province->province_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>المدينة</label>
        <input type="text" name="city" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>العنوان</label>
        <input type="text" name="address" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>الهاتف</label>
        <input type="text" name="phone" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">حفظ</button>
    <a href="{{ route('stores.index') }}" class="btn btn-secondary">إلغاء</a>
</form>
@endsection