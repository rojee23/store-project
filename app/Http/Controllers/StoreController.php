<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    // ============================
    // 1) عرض الإحصائيات
    // ============================
    public function statistics()
    {
        // مؤقتاً نرجع عدد المتاجر بكل محافظة
        $counts = Province::withCount('stores')->get();

        return view('stores.statistics', compact('counts'));
    }

    // ============================
    // 2) عرض قائمة المتاجر
    // ============================
    public function index(Request $request)
    {
        $query = Store::query();

        if ($search = $request->input('search')) {
            $query->where('store_name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
        }

        $stores = $query->paginate(10);

        return view('stores.index', compact('stores'));
    }

    // ============================
    // 3) صفحة إنشاء متجر
    // ============================
    public function create()
    {
        return view('stores.create');
    }

    // ============================
    // 4) حفظ متجر جديد
    // ============================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'store_name'  => 'required|string|max:50',
            'city'        => 'required|string|max:50',
            'address'     => 'required|string|max:50',
            'phone'       => 'required|string|max:50',
            'upload_file' => 'nullable|file'
        ]);

        // رفع الملف إذا موجود
        if ($request->hasFile('upload_file')) {
            $fileName = time() . '.' . $request->upload_file->extension();
            $request->upload_file->move(public_path('uploads'), $fileName);
            $validated['upload_file'] = $fileName;
        }

        Store::create($validated);

        return redirect()
            ->route('stores.index')
            ->with('success', 'تم إنشاء المتجر بنجاح');
    }

    // ============================
    // 5) عرض متجر
    // ============================
    public function show($id)
    {
        $store = Store::findOrFail($id);
        return view('stores.show', compact('store'));
    }

    // ============================
    // 6) تعديل متجر
    // ============================
    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('stores.edit', compact('store'));
    }

    // ============================
    // 7) تحديث متجر
    // ============================
    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $validated = $request->validate([
            'store_name'  => 'required|string|max:50',
            'city'        => 'required|string|max:50',
            'address'     => 'required|string|max:50',
            'phone'       => 'required|string|max:50',
            'upload_file' => 'nullable|file'
        ]);

        // رفع الملف إذا موجود
        if ($request->hasFile('upload_file')) {
            $fileName = time() . '.' . $request->upload_file->extension();
            $request->upload_file->move(public_path('uploads'), $fileName);
            $validated['upload_file'] = $fileName;
        }

        $store->update($validated);

        return redirect()
            ->route('stores.index')
            ->with('success', 'تم تحديث المتجر بنجاح');
    }

    // ============================
    // 8) حذف متجر
    // ============================
    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();

        return redirect()
            ->route('stores.index')
            ->with('success', 'تم حذف المتجر بنجاح');
    }
}
