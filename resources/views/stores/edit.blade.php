@extends('layouts.app')
@section('title', 'تعديل فرع')

@section('content')
<h2>تعديل فرع</h2>
<form action="{{ route('stores.update', $store->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>اسم الفرع</label>
        <input type="text" name="store_name" class="form-control" value="{{ old('store_name', $store->store_name) }}" required>
    </div>
    <div class="mb-3">
        <label>المحافظة</label>
        <select name="province_id" class="form-control" required>
            <option value="">اختر المحافظة</option>
            @foreach(\App\Models\Province::all() as $province)
                <option value="{{ $province->id }}" {{ $store->province_id == $province->id ? 'selected' : '' }}>
                    {{ $province->province_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>المدينة</label>
        <input type="text" name="city" class="form-control" value="{{ old('city', $store->city) }}" required>
    </div>
    <div class="mb-3">
        <label>العنوان</label>
        <input type="text" name="address" class="form-control" value="{{ old('address', $store->address) }}" required>
    </div>
    <div class="mb-3">
        <label>الهاتف</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $store->phone) }}" required>
    </div>
    <button type="submit" class="btn btn-primary">تحديث</button>
    <a href="{{ route('stores.index') }}" class="btn btn-secondary">إلغاء</a>
</form>
@endsection