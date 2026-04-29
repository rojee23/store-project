@extends('layouts.app')
@section('title', 'إدارة فروع المتجر')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">
        <i class="fas fa-store-alt me-2"></i> إدارة فروع المتجر
    </h2>

    <a href="{{ route('stores.create') }}" class="btn btn-success rounded-pill">
        <i class="fas fa-plus me-1"></i> إضافة فرع جديد
    </a>
</div>

{{--  --}}
<div class="input-group mb-3">
    <input type="text" id="searchInput" class="form-control" placeholder="ابحث عن فرع بالاسم أو المدينة..." value="{{ request('search') }}">
    <button class="btn btn-primary" onclick="doSearch()">
        <i class="fas fa-search"></i> بحث
    </button>

    @if(request('search'))
        <a href="{{ route('stores.index') }}" class="btn btn-outline-secondary ms-2">مسح البحث</a>
    @endif
</div>

{{-- جدول الفروع --}}
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-list me-1"></i> قائمة الفروع
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="storesTable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>اسم الفرع</th>
                        <th>المدينة</th>
                        <th>الهاتف</th>
                        <th class="text-center">إجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($stores as $store)
                    <tr>
                        <td>{{ $store->store_id }}</td>
                        <td><strong>{{ $store->store_name }}</strong></td>
                        <td>{{ $store->city }}</td>
                        <td>{{ $store->phone }}</td>

                        <td class="text-center">
                            <a href="{{ route('stores.edit', $store->store_id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('stores.destroy', $store->store_id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">لا توجد فروع بعد.</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-center mt-3">
    {{ $stores->appends(['search' => request('search')])->links() }}
</div>

@endsection

{{-- سكربت البحث --}}
<script>
function doSearch() {
    let query = document.getElementById('searchInput').value.trim();
    if (query) {
        window.location.href = "{{ route('stores.index') }}?search=" + encodeURIComponent(query);
    } else {
        window.location.href = "{{ route('stores.index') }}";
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            doSearch();
        }
    });
});
</script>
