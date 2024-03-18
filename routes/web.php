<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
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
/*
|Frontend for the user's
*/

Route::get('/',[FrontendController::class,'index'])->name('frontend.index');
Route::get('/ecommerce/{product}',[FrontendController::class,'show'])->name('detail.show');

//Cart controller
Route::resource('carts', CartController::class)->names([
    'store' => 'carts.store',
]);  

Route::get('/dashboard',[FrontendController::class,'index'])->name('frontend.index')->middleware(['auth', 'verified'])->name('dashboard');

//Auth controller
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['prefix' => 'admin','middleware' => 'auth'],function()
{
    Route::get('/',[AdminController::class, 'index'])->name('admin.index');

    //usercontroller
      
    //Categories controller
    Route::resource('categories', CategoryController::class);
    
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





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';