<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'supplier', 'attributes')->get();
        return view('admin.products.index', compact('products'));
    }
    

    /**
     * عرض صفحة إنشاء منتج جديد.
     */
    public function create()
    {
        $categories = Category::all(); // فقط جلب الفئات
        $suppliers = Supplier::all();
        $attributes = Attribute::all(); // جميع الصفات متاحة للاختيار
        return view('admin.products.create', compact('categories', 'suppliers', 'attributes'));
    }


    /**
 * تخزين المنتج الجديد مع الصور والصفات.
 */
    public function store(Request $request)
        {
            // التحقق من البيانات المدخلة
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'category_id' => 'required|exists:categories,id',
                'supplier_id' => 'required|exists:suppliers,id',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'attributes' => 'nullable|array',
                'attributes.*.name' => 'required_with:attributes|string|max:255',
                'attributes.*.value' => 'required_with:attributes|string|max:255',
            ]);

            // إنشاء المنتج
            $product = Product::create($validated);

            // رفع الصور وحفظها
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('products', 'public');
                    $product->images()->create([
                        'image_url' => $path,
                        'is_primary' => $index === 0, // أول صورة تعتبر رئيسية
                    ]);
                }
            }

            // حفظ الصفات وقيمها
            if ($request->has('attributes')) {
                foreach ($request->input('attributes') as $attribute) {
                    if (!empty($attribute['name']) && !empty($attribute['value'])) {
                        $attr = Attribute::firstOrCreate(['name' => $attribute['name']]);
                        $product->attributes()->attach($attr->id, ['value' => $attribute['value']]);
                    }
                }
            }

            return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
        }

        
    /**
 * عرض صفحة تعديل المنتج مع الصفات.
 */
    public function edit($id)
    {
        $product = Product::with(['images', 'attributes'])->findOrFail($id);
        $categories = Category::all();
        $suppliers = Supplier::all();
        $attributes = Attribute::all(); // جلب كل الصفات
        return view('admin.products.edit', compact('product', 'categories', 'suppliers', 'attributes'));
    }

    /**
 * تحديث بيانات المنتج مع الصور والصفات.
 */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->update($validated);

        // تحديث الصور
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create(['image_url' => $path]);
            }
        }
        if ($request->remove_images) {
            $product->images()->whereIn('id', $request->remove_images)->each(function ($image) {
                Storage::disk('public')->delete($image->image_url);
                $image->delete();
            });
        }

        // تحديث الصفات
        if ($request->has('attributes')) {
            foreach ($request->attributes as $attributeData) {
                if (isset($attributeData['remove']) && $attributeData['remove']) {
                    AttributeValue::find($attributeData['id'])->delete();
                } else {
                    AttributeValue::find($attributeData['id'])->update(['value' => $attributeData['value']]);
                }
            }
        }

        // إضافة صفات جديدة
        if ($request->has('new_attributes')) {
            foreach ($request->new_attributes as $newAttribute) {
                if (!empty($newAttribute['name']) && !empty($newAttribute['value'])) {
                    $attribute = Attribute::firstOrCreate(['name' => $newAttribute['name']]);
                    $product->attributes()->attach($attribute->id, ['value' => $newAttribute['value']]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }



    /**
     * حذف المنتج مع الصور المرتبطة.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // حذف الصور من التخزين
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_url);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
