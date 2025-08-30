<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MakerController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductVariantController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* Admin Routes */

Route::middleware(['guest:admin'])->group(function () {
    Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::resource('products', ProductController::class)->names([
        'index' => 'admin.products',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'show' => 'admin.products.show',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);
    Route::resource('categories', CategoryController::class)->names([
        'index' => 'admin.categories',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'show' => 'admin.categories.show',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);
    Route::resource('makers', MakerController::class)->names([
        'index' => 'admin.makers',
        'create' => 'admin.makers.create',
        'store' => 'admin.makers.store',
        'show' => 'admin.makers.show',
        'edit' => 'admin.makers.edit',
        'update' => 'admin.makers.update',
        'destroy' => 'admin.makers.destroy',
    ]);
    Route::post('/product_variants/store/{product}', [ProductVariantController::class, 'store'])
    ->name('admin.product_variants.store');
    Route::resource('product_variants', ProductVariantController::class)->names([      
        'index' => 'admin.product_variants',
        'create' => 'admin.product_variants.create',
        'show' => 'admin.product_variants.show',
        'edit' => 'admin.product_variants.edit',
        'update' => 'admin.product_variants.update',
        'destroy' => 'admin.product_variants.destroy',
    ])->except(['store']);    
    Route::resource('sizes', SizeController::class)->names([
        'index' => 'admin.sizes',
        'create' => 'admin.sizes.create',
        'store' => 'admin.sizes.store',
        'show' => 'admin.sizes.show',
        'edit' => 'admin.sizes.edit',
        'update' => 'admin.sizes.update',
        'destroy' => 'admin.sizes.destroy',
    ]);
    Route::resource('colors', ColorController::class)->names([
        'index' => 'admin.colors',
        'create' => 'admin.colors.create',
        'store' => 'admin.colors.store',
        'show' => 'admin.colors.show',
        'edit' => 'admin.colors.edit',
        'update' => 'admin.colors.update',
        'destroy' => 'admin.colors.destroy',
    ]);
    
    
    // Route::get('/admin/profile', [ProfileController::class, 'editAdmin'])->name('admin.profile.edit');
    // Route::patch('/admin/profile', [ProfileController::class, 'updateAdmin'])->name('admin.profile.update');
});

require __DIR__.'/auth.php';
