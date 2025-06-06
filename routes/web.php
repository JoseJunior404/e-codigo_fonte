<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Product;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// user route
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// end user route

//////////////////////////////////////////////////////////**/*\**\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

// admin route
Route::group(['prefix'=>'admin', 'middleware'=>'redirectAdmin'], function(){
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    // Route::post('logout',function()
    // {
    //     return 'teste';
    // })->name('admin.logout');
});

Route::middleware(['auth','admin'])->prefix('admin')->group(function(){
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    
    // Products routes
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');

});

// end admin route

require __DIR__.'/auth.php';
