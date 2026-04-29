<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Province;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // عدد الفروع
        $storesCount = Store::count();

        // عدد المحافظات
        $provincesCount = Province::count();

        // آخر 5 فروع مضافة
        $recentStores = Store::latest('store_id')->take(5)->get();

        // عرض أول 5 محافظات فقط (لأن ما في علاقة stores)
        $provinces = Province::take(5)->get();

        return view('dashboard', compact(
            'storesCount',
            'provincesCount',
            'recentStores',
            'provinces'
        ));
    }
}
