<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    // عرض جميع الموردين
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    // عرض صفحة إضافة مورد جديد
    public function create()
    {
        return view('admin.suppliers.create');
    }

    // حفظ مورد جديد
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string|max:15',
            'api_url' => 'nullable|url',
            'api_key' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        Supplier::create($validatedData);
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier created successfully!');
    }

    // عرض صفحة تعديل مورد
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    // تحديث بيانات مورد
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string|max:15',
            'api_url' => 'nullable|url',
            'api_key' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($validatedData);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier updated successfully!');
    }

    // حذف مورد
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier deleted successfully!');
    }
}
