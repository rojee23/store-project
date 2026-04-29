@extends('layouts.app')
@section('title', 'تفاصيل المحافظة')

@section('content')
<div class="container mt-4">

    <h2 class="fw-bold mb-4">
        <i class="fas fa-map-marker-alt me-2"></i> تفاصيل المحافظة
    </h2>

    <div class="card shadow-sm p-4">

        <p class="fs-5">
            <strong>اسم المحافظة:</strong>
            {{ $province->province_name }}
        </p>

        <div class="mt-4">
            <a href="{{ route('provinces.index') }}" class="btn btn-secondary rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> رجوع
            </a>
        </div>

    </div>

</div>
@endsection
