@extends('layouts.app')
@section('title', 'المحافظات')

@section('content')
<h2>قائمة المحافظات</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>اسم المحافظة</th>
            <th>إجراءات</th>
        </tr>
    </thead>
    <tbody>
        @forelse($provinces as $province)
        <tr>
            <td>{{ $province->id }}</td>
            <td>{{ $province->province_name }}</td>
            <td>
                <a href="{{ route('provinces.edit', $province->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                <form action="{{ route('provinces.destroy', $province->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">لا توجد محافظات بعد.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<a href="{{ route('provinces.create') }}" class="btn btn-success">
    <i class="fas fa-plus"></i> إضافة محافظة جديدة
</a>
@endsection
@push('scripts')
<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    let query = this.value;
    fetch(/api/stores/search?q=${query})
        .then(response => response.json())
        .then(data => {
            let tbody = document.querySelector('#storesTable tbody');
            tbody.innerHTML = '';
            data.forEach(store => {
                tbody.innerHTML += 
                    <tr>
                        <td>${store.id}</td>
                        <td>${store.store_name}</td>
                        <td>${store.province.province_name}</td>
                        <td>${store.city}</td>
                        <td>${store.phone}</td>
                        <td>
                            <a href="/stores/${store.id}/edit" class="btn btn-sm btn-warning">تعديل</a>
                            <form action="/stores/${store.id}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">حذف</button>
                            </form>
                        </td>
                    </tr>
                ;
            });
        });
});
</script>
@endpush