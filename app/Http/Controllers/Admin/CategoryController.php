<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // عرض جميع الفئات
    public function index()
    {
        $categories = Category::all(); // جلب جميع الفئات
        return view('admin.categories.index', compact('categories'));
    }

    // عرض صفحة إنشاء فئة جديدة
    public function create()
    {
        return view('admin.categories.create');
    }

    // تخزين الفئة الجديدة
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon_url' => 'nullable|url',
        ]);

        Category::create($request->all()); // إنشاء فئة جديدة
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    // عرض صفحة تعديل فئة
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    // تحديث بيانات الفئة
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon_url' => 'nullable|url',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all()); // تحديث بيانات الفئة
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    // حذف الفئة
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete(); // حذف الفئة
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
}
