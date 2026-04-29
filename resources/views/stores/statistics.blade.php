@extends('layouts.app')
@section('title', 'إحصائيات الفروع')

@section('content')
<div class="container mt-4">

    <h2 class="fw-bold mb-4">
        <i class="fas fa-chart-pie me-2"></i> عدد الفروع في كل محافظة
    </h2>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>المحافظة</th>
                        <th>عدد الفروع</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($counts as $row)
                    <tr>
                        <td>{{ $row->province_name }}</td>
                        <td>
                            <span class="badge bg-primary rounded-pill">
                                {{ $row->branch_count }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center text-muted py-4">
                            لا توجد بيانات
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

    <a href="{{ route('stores.index') }}" class="btn btn-secondary rounded-pill mt-3">
        <i class="fas fa-arrow-left me-1"></i> العودة للفروع
    </a>

</div>
@endsection
