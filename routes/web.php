<?php
use App\Http\Controllers\UserProductController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SupplierController;


Route::get('/', function () {
    return view('home');  // هنا سيستخدم Laravel ملف resources/views/home.blade.php
});
Route::get('/contact', function () {
    return view('contact'); // اسم ملف Blade هو contact.blade.php
})->name('contact');

Route::get('/about', function () {
    return view('about'); 
})->name('about');

Route::get('/customers', function () {
    return view('customers');  // هنا سيستخدم Laravel ملف resources/views/home.blade.php
});

// صفحة عرض المنتجات مع التبويبات
Route::get('/userproducts', [UserProductController::class, 'index'])->name('userproducts.index');

// صفحة تفاصيل المنتج
Route::get('/userproducts/{id}', [UserProductController::class, 'details'])->name('userproducts.details');

//Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

//Dashboard:
// التوجيهات لإدارة المنتجات
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});

// التوجيهات لإدارة الفئات
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories',CategoryController::class);
});

// التوجيهات لإدارة الموردين
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('suppliers', SupplierController::class);
});

