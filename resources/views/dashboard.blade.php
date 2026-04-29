@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

{{-- عنوان رئيسي --}}
<div class="mb-4">
    <h2 class="fw-bold">
        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
    </h2>
    <p class="text-muted">Welcome back! Here’s an overview of your system.</p>
</div>

{{-- بطاقات الإحصائيات --}}
<div class="row g-4 mb-5">

    {{-- عدد الفروع --}}
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 rounded-circle p-3" style="background: #e8dff5;">
                    <i class="fas fa-store fa-2x" style="color: #6f42c1;"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">{{ $storesCount }}</h5>
                    <small class="text-muted">Total Stores</small>
                </div>
            </div>
        </div>
    </div>

    {{-- عدد المحافظات --}}
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 rounded-circle p-3" style="background: #e8dff5;">
                    <i class="fas fa-map-marker-alt fa-2x" style="color: #6f42c1;"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">{{ $provincesCount }}</h5>
                    <small class="text-muted">Provinces</small>
                </div>
            </div>
        </div>
    </div>

    {{-- رابط سريع لإدارة الفروع --}}
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="fw-bold text-primary">Manage Stores</h6>
                    <small class="text-muted">Add, edit or delete stores</small>
                </div>
                <a href="{{ route('stores.index') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                    Go <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

</div>

{{-- أحدث الفروع --}}
<div class="card mb-4">
    <div class="card-header"><i class="fas fa-clock me-1"></i> Recent Stores</div>
    <div class="card-body p-0">
        @if($recentStores->isEmpty())
            <p class="text-center text-muted py-4">No stores yet.</p>
        @else
        <div class="table-responsive">
            <table class="table table-sm table-hover mb-0">
                <thead class="table-light">
                    <tr><th>Store</th><th>City</th><th>Phone</th></tr>
                </thead>
                <tbody>
                    @foreach($recentStores as $store)
                    <tr>
                        <td><strong>{{ $store->store_name }}</strong></td>
                        <td>{{ $store->city }}</td>
                        <td>{{ $store->phone }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

{{-- المحافظات --}}
<div class="card">
    <div class="card-header"><i class="fas fa-map me-1"></i> Provinces</div>
    <div class="card-body p-0">
        @if($provinces->isEmpty())
            <p class="text-center text-muted py-4">No provinces yet.</p>
        @else
        <div class="table-responsive">
            <table class="table table-sm table-hover mb-0">
                <thead class="table-light">
                    <tr><th>Province</th></tr>
                </thead>
                <tbody>
                    @foreach($provinces as $p)
                    <tr>
                        <td>{{ $p->province_name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

@endsection
