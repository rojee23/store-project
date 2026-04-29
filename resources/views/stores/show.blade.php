@extends('layouts.app')
@section('title', 'تفاصيل الفرع')

@section('content')
<div class="container mt-4">

    <h2 class="fw-bold mb-4">
        <i class="fas fa-store-alt me-2"></i> تفاصيل الفرع
    </h2>

    <div class="card shadow-sm p-4">

        <p class="fs-5"><strong>اسم الفرع:</strong> {{ $store->store_name }}</p>

        <p class="fs-5"><strong>المدينة:</strong> {{ $store->city }}</p>

        <p class="fs-5"><strong>العنوان:</strong> {{ $store->address }}</p>

        <p class="fs-5"><strong>الهاتف:</strong> {{ $store->phone }}</p>

        @if($store->upload_file)
            <p class="fs-5"><strong>ملف البروشور:</strong></p>
            <a href="{{ asset('uploads/' . $store->upload_file) }}"
               class="btn btn-primary rounded-pill"
               download>
                <i class="fas fa-file-download me-1"></i> تنزيل البروشور
            </a>
        @endif

        <div class="mt-4">
            <a href="{{ route('stores.index') }}" class="btn btn-secondary rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> رجوع
            </a>
        </div>

    </div>

</div>
@endsection
