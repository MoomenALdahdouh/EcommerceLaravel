<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

/*Route::get('/try', function () {
    return view('try');
});*/

Route::get('/category/all',[CategoryController::class,'allCat'])->name('all.categories');
Route::post('/category/add',[CategoryController::class,'addCat'])->name('add.category');
Route::get('/category/edit/{id}',[CategoryController::class,'editCat'])->name('edit.category');
Route::post('/category/update/{id}',[CategoryController::class,'updateCat'])->name('update.category');
Route::get('/softdelete/category/{id}',[CategoryController::class,'deleteCat'])->name('delete.category');
Route::get('/forcedelete/category/{id}',[CategoryController::class,'forcedeleteCat'])->name('forcedelete.category');
Route::get('/category/restore/{id}',[CategoryController::class,'restoreCat'])->name('restore.category');

Route::get('/item/all',[ItemController::class,'allItem'])->name('all.items');

Route::get('/brand/all',[BrandController::class,'allBrand'])->name('all.brand');

Route::get('/contact-with-us', function () {
    return view('contact');
})->name('contact');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //$users = User::all(); //First Way, you must import User class in the top
    $users = DB::table('users')->get(); //Second way, you must import DB class in the top
    return view('dashboard',compact('users'));
})->name('dashboard');
