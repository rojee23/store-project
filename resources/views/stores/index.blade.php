@extends('layouts.app')
@section('title', 'قائمة الفروع')

@section('content')
<h2 class="mb-4">إدارة فروع المتجر</h2>

<!-- شريط البحث مع زر -->
<div class="input-group mb-3">
    <input type="text" id="searchInput" class="form-control" placeholder="ابحث عن فرع...">
    <button class="btn btn-primary" type="button" onclick="doSearch()">
        <i class="fas fa-search"></i> بحث
    </button>
</div>

<table class="table table-bordered table-striped" id="storesTable">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>اسم الفرع</th>
            <th>المحافظة</th>
            <th>المدينة</th>
            <th>الهاتف</th>
            <th>إجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stores as $store)
        <tr>
            <td>{{ $store->id }}</td>
            <td>{{ $store->store_name }}</td>
            <td>{{ $store->province ? $store->province->province_name : '' }}</td>
            <td>{{ $store->city }}</td>
            <td>{{ $store->phone }}</td>
            <td>
                <a href="{{ route('stores.edit', $store->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                <form action="{{ route('stores.destroy', $store->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $stores->links() }}

<a href="{{ route('stores.create') }}" class="btn btn-success">
    <i class="fas fa-plus"></i> إضافة فرع جديد
</a>
@endsection

@section('scripts')
<script>
function doSearch() {
    let query = document.getElementById('searchInput').value;
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
                        <td>${store.province ? store.province.province_name : ''}</td>
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
        })
        .catch(error => console.error('Error:', error));
}

// السماح بالبحث أيضاً عند الضغط على Enter
document.getElementById('searchInput').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        doSearch();
    }
});
</script>
@endsection