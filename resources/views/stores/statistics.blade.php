@extends('layouts.app')
@section('title', 'إحصائيات الفروع')

@section('content')
<div class="container">
    <h2 class="mb-4">عدد الفروع في كل محافظة</h2>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr><th>المحافظة</th><th>عدد الفروع</th></tr>
        </thead>
        <tbody>
            @forelse($counts as $row)
            <tr>
                <td>{{ $row->province_name }}</td>
                <td>{{ $row->branch_count }}</td>
            </tr>
            @empty
            <tr><td colspan="2">لا توجد بيانات</td></tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('stores.index') }}" class="btn btn-secondary">العودة للفروع</a>
</div>
@endsection