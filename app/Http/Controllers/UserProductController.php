<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class UserProductController extends Controller
{
    public function index()
    {
        // جلب جميع المنتجات
        $allProducts = Product::with(['images', 'attributes'])->get();

        // جلب جميع الفئات مع المنتجات المرتبطة
        $categories = Category::with(['products.images', 'products.attributes'])->get();

        // عرض صفحة المنتجات مع تمرير البيانات
        return view('userproducts', compact('allProducts', 'categories'));
    }

    // عرض تفاصيل المنتج
    public function details($id)
    {
        $product = Product::with(['images', 'attributes'])->findOrFail($id);

        return view('productdetails', compact('product'));
    }
}
