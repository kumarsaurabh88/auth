<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\blogController;
use App\Http\Controllers\blogImageController;
use App\Http\Controllers\YourController;
use App\Http\Middleware\CustomerMiddleware;
use App\Http\Middleware\BlockCustomerAccess;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//from newfile

Route::get('/blogs',[blogController::class,'index'])->name('blogs.index');
Route::get('/blogs/create',[blogController::class,'create'])->name('blogs.create');
Route::post('/blogs/store',[blogController::class,'store'])->name('blogs.store');
Route::get('/blogs/{blog}/edit',[blogController::class,'edit'])->name('blogs.edit');
Route::put('/blogs/{blog}',[blogController::class,'update'])->name('blogs.update');
Route::delete('/blogs/{blog}',[blogController::class,'destroy'])->name('blogs.destroy');
Route::get('/blogs/search',[blogController::class,'search'])->name('blogs.search');
Route::get('/blogs/found',[blogController::class,'found'])->name('blogs.found');
// Route::get('/blogs/customerBlogs',[blogController::class,'customerBlogs'])->name('blogs.customerBlogs');
Route::get('/blogs/customerBlogs', [BlogController::class, 'customerBlogs'])->name('blogs.customerBlogs');

// Route::get('/blogs/profile',[blogController::class,'profile'])->name('blogs.profile');

Route::get('/blogs/{blogId}/upload',[blogImageController::class,'index']);




// Route::post('/blogs/bulk-delete',[blogController::class,'bulkDelete']);

// Route::delete('/blogs/bulk-delete',[blogController::class,'bulkDelete']);
Route:: delete('/blog/bulk-delete', [blogController::class,'bulkDelete'])->name('blogs.bulk-delete');


Route::middleware([CustomerMiddleware::class])->group(function () {
    // Routes accessible only to authenticated customers
    Route::get('/blogs/dashboard', [blogController::class, 'customerDashboard'])->name('blogs.dashboard');

    Route::middleware([BlockCustomerAccess::class])->group(function () {
        // Routes accessible only to non-customer users
        Route::get('/auth/dashboard', [blogController::class, 'profile'])->name('blogs.dashboard');

        Route::resource('blogs', blogController::class);
    });
});