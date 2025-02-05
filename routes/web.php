<?php

use App\Http\Controllers\Admin\ProductCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesignController;
use App\Livewire\DesignFilter;
use App\Http\Controllers\ProductController;
use App\Livewire\ImportExport;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('login');
});

// ✅ Wrap all routes inside the auth middleware
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('designs');
    })->name('dashboard');

    // Route::resource('product-categories', ProductCategoryController::class);
    // Route::resource('designs', DesignController::class);

    Route::get('/designs', DesignFilter::class)->name('designs');
    Route::get('/export/{format}', [DesignFilter::class, 'export'])->name('export');

    Route::get('/import-file', [ImportExport::class, 'import'])->name('import');


    Route::get('/download-sample', [ImportExport::class, 'downloadSample'])->name('download-sample');


    Route::get('/get-subcategories/{categoryId}', [ProductController::class, 'getSubcategories']);
    Route::get('/get-finishes/{categoryId}', [ProductController::class, 'getFinishes']);
});


// Route::prefix('admin')
//     ->name('admin.')
//     ->middleware(['auth', 'admin'])
//     ->group(function () {
//         Route::resource('product_categories', ProductCategoryController::class);
//         Route::resource('products', ProductController::class);

//     });

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::group(['middleware' => function ($request, $next) {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }], function () {
        Route::resource('product_categories', ProductCategoryController::class);
        Route::resource('products', ProductController::class);
    });
});
