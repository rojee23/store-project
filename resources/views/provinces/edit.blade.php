@extends('layouts.app')
@section('title', 'تعديل محافظة')

@section('content')
<h2>تعديل محافظة</h2>

<form action="{{ route('provinces.update', $province->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label for="province_name" class="form-label">اسم المحافظة</label>
        <input type="text" name="province_name" id="province_name" class="form-control" value="{{ old('province_name', $province->province_name) }}" required>
        @error('province_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">تحديث</button>
    <a href="{{ route('provinces.index') }}" class="btn btn-secondary">إلغاء</a>
</form>
@endsection