<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\MainCategoryController;

Route::get('/', [WebsiteController::class, 'index'])->name('home');
Route::get('/about', [WebsiteController::class, 'about'])->name('about');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');
Route::get('/shop', [WebsiteController::class, 'shop'])->name('shop');
Route::get('/product-details', [WebsiteController::class, 'productDetails'])->name('product.details');
Route::get('/cart', [WebsiteController::class, 'cart'])->name('cart');




Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/checkout', [WebsiteController::class, 'checkout'])->name('checkout');
});


// This route for Admin

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth:admin'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
        Route::put('/profule/update', [ProfileController::class, 'update'])->name('admin.profile.update');

        // Category section
        Route::get('/main-category', [MainCategoryController::class, 'index'])->name('admin.maincategory');
        Route::post('/main-category', [MainCategoryController::class, 'store'])->name('maincategory.store');
        Route::get('/main-category/edit/{id}', [MainCategoryController::class, 'edit'])->name('admin.EditMaincategory');
        Route::put('/main-category/update/{id}', [MainCategoryController::class, 'update'])->name('maincategory.update');
        Route::delete('/main-category/delete/{id}', [MainCategoryController::class, 'destroy'])->name('mainCategory.delete');


        // Sub-category section
        Route::get('/sub-category', [SubCategoryController::class, 'index'])->name('admin.subcategory');
        Route::post('/sub-category', [SubCategoryController::class, 'store'])->name('subcategory.store');
        Route::get('/sub-category/edit/{id}', [SubCategoryController::class, 'edit'])->name('admin.Editsubcategory');
        Route::put('/sub-category/update/{id}', [SubCategoryController::class, 'update'])->name('subcategory.update');
        Route::delete('/sub-category/delete/{id}', [SubCategoryController::class, 'destroy'])->name('subcategory.delete');

        // Brand section
        Route::get('/brand', [BrandController::class, 'index'])->name('admin.brand');
        Route::post('/brand', [BrandController::class, 'store'])->name('brand.store');
        Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.Edit');
        Route::put('/brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
        Route::delete('/brand/delete/{id}', [BrandController::class, 'destroy'])->name('brand.delete');

        // Brand section
        Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
        Route::get('/products/add', [ProductController::class, 'add'])->name('product.add');
         Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
        //  Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.Edit');
        //  Route::put('/brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
        //  Route::delete('/brand/delete/{id}', [BrandController::class, 'destroy'])->name('brand.delete');

       

        // New field section
        // Route::post('/fields', [FieldController::class, 'store'])->name('fields.store');
    });
});

