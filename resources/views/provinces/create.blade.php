@extends('layouts.app')
@section('title', 'إضافة محافظة جديدة')

@section('content')
<h2>إضافة محافظة جديدة</h2>

<form action="{{ route('provinces.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="province_name" class="form-label">اسم المحافظة</label>
        <input type="text" name="province_name" id="province_name" class="form-control" value="{{ old('province_name') }}" required>
        @error('province_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">حفظ</button>
    <a href="{{ route('provinces.index') }}" class="btn btn-secondary">إلغاء</a>
</form>
@endsection