@extends('layouts.app')
@section('title', 'قائمة المحافظات')

@section('content')

{{-- عرض رسائل النجاح --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="fas fa-map-marker-alt me-2"></i> قائمة المحافظات</h2>
    <a href="{{ route('provinces.create') }}" class="btn btn-success rounded-pill">
        <i class="fas fa-plus me-1"></i> إضافة محافظة جديدة
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-list me-1"></i> المحافظات
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>اسم المحافظة</th>
                        <th class="text-center">إجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($provinces as $province)
                    <tr>
                        <td>{{ $province->province_id }}</td>
                        <td><strong>{{ $province->province_name }}</strong></td>
                        <td class="text-center">

                            <a href="{{ route('provinces.edit', $province->province_id) }}"
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('provinces.destroy', $province->province_id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">
                            لا توجد محافظات بعد.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
