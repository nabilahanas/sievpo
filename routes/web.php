<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\WIlayahController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/ceklogin', [AuthController::class, 'ceklogin'])->name('ceklogin')->middleware('guest');
Route::post('/registered', [AuthController::class, 'registered'])->name('registered')->middleware('guest');
// Route::get('/home', [NavController::class, 'home'])->name('home')->middleware('home');
Route::get('/home', [NavController::class, 'dashboard'])->name('dashboard');

Route ::prefix("wilayah")->group(function(){
    Route::get('/', [WilayahController::class, 'index'])->name('wilayah.index');
    Route::get('add/{id}', [WilayahController::class, 'add'])->name('wilayah.add');
    Route::post('store', [WilayahController::class, 'store'])->name('wilayah.store');
    Route::get('edit/{id}', [WilayahController::class, 'edit'])->name('wilayah.edit');
    Route::post('update/{id}', [WilayahController::class, 'update'])->name('wilayah.update');
    Route::post('delete/{id}', [WilayahController::class, 'delete'])->name('wiayah.delete');
    Route::post('recycle/{id}', [WilayahController::class, 'recycle'])->name('wilayah.recycle');
    Route::get('restore/{id}', [WilayahController::class, 'restore'])->name('wilayah.restore');
    });