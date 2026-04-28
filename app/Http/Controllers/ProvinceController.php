<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinces = Province::all();
        return view('provinces.index', compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('provinces.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'province_name' => 'required|string|max:50|unique:provinces,province_name'
        ]);

        Province::create($validated);
        return redirect()->route('provinces.index')->with('success', 'تمت إضافة المحافظة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Province $province)
    {
        return view('provinces.show', compact('province'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Province $province)
    {
        return view('provinces.edit', compact('province'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Province $province)
    {
       $validated = $request->validate([
    'province_name' => 'required|string|max:50|unique:province,province_name,' . $province->province_id . ',province_id'
]);

        $province->update($validated);
        return redirect()->route('provinces.index')->with('success', 'تم تحديث المحافظة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Province $province)
    {
        $province->delete();
        return redirect()->route('provinces.index')->with('success', 'تم حذف المحافظة بنجاح');
    }
}
