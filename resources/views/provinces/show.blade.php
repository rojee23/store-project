@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">تفاصيل المحافظة</h2>

    <div class="card p-4">

        <p><strong>اسم المحافظة:</strong> {{ $province->province_name }}</p>

        <div class="mt-4">
            <a href="{{ route('provinces.index') }}" class="btn btn-secondary">رجوع</a>
        </div>

    </div>

</div>
@endsection
