<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//What would be seen when you first open the project
Route::get('/', function () {
    return view('ecommerce.index');
});

Route::get('/dashboard', function () {
    return view('ecommerce.index');
})->middleware(['auth', 'verified'])->name('dashboard');

//Auth controller
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['prefix' => 'admin','middleware' => 'auth'],function()
{
  Route::get('/', function () {
    return view('admin.index');
});
      
    //Categories controller
    Route::resource('categories', CategoryController::class);
    //Cart controller
    Route::resource('carts', CartController::class);
    //Stock controller
    Route::resource('stocks', StockController::class);
    // Route::get('stocks/create',[StockController::class, 'create'])->name('stocks.create');

    //productController
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create',[ProductController::class, 'create'])->name('products.create');
    Route::post('/products',[ProductController::class,'store'])->name('products.store');
    Route::get('/products/{product}',[ProductController::class,'show'])->name('products.show');
    Route::get('products/{product}/edit',[ProductController::class,'edit'])->name('products.edit');
    Route::put('products/{[product}',[ProductController::class,'update'])->name('products.update');
    Route::delete('products/{product}',[ProductController::class, 'destroy'])->name('products.destroy');
    Route::middleware('auth')->group(function(){
    });

});

require __DIR__.'/auth.php';


