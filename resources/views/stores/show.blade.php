@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">تفاصيل المتجر</h2>

    <div class="card p-4">

        <p><strong>اسم المتجر:</strong> {{ $store->store_name }}</p>

        <p><strong>المحافظة:</strong>
            {{ $store->province ? $store->province->province_name : 'غير محدد' }}
        </p>

        <p><strong>المدينة:</strong> {{ $store->city }}</p>

        <p><strong>العنوان:</strong> {{ $store->address }}</p>

        <p><strong>الهاتف:</strong> {{ $store->phone }}</p>

        @if($store->upload_file)
            <p><strong>ملف البروشور:</strong></p>
            <a href="{{ asset('uploads/' . $store->upload_file) }}" class="btn btn-primary" download>
                تنزيل الملف
            </a>
        @endif

        <div class="mt-4">
            <a href="{{ route('stores.index') }}" class="btn btn-secondary">رجوع</a>
        </div>

    </div>

</div>
@endsection
