<?php

use App\Http\Controllers\BidangController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;

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
    return view('landing.home');
});

Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/ceklogin', [AuthController::class, 'ceklogin'])->name('ceklogin')->middleware('guest');
Route::post('/registered', [AuthController::class, 'registered'])->name('registered')->middleware('guest');
// Route::get('/home', [NavController::class, 'home'])->name('home')->middleware('home');
Route::get('/home', [NavController::class, 'dashboard'])->name('dashboard');

Route::prefix("wilayah")->group(function () {
    Route::get('add', [WilayahController::class, 'create'])->name('wilayah.add');
    Route::post('store', [WilayahController::class, 'store'])->name('wilayah.store');
    Route::get('/', [WilayahController::class, 'index'])->name('wilayah.index');
    Route::get('edit/{id}', [WilayahController::class, 'edit'])->name('wilayah.edit');
    Route::post('update/{id}', [WilayahController::class, 'update'])->name('wilayah.update');
    Route::post('delete/{id}', [WilayahController::class, 'delete'])->name('wilayah.delete');
});

Route::prefix("jabatan")->group(function () {
    Route::get('add', [JabatanController::class, 'create'])->name('jabatan.add');
    Route::post('store', [JabatanController::class, 'store'])->name('jabatan.store');
    Route::get('/', [JabatanController::class, 'index'])->name('jabatan.index');
    Route::get('edit/{id}', [JabatanController::class, 'edit'])->name('jabatan.edit');
    Route::post('update/{id}', [JabatanController::class, 'update'])->name('jabatan.update');
    Route::post('delete/{id}', [JabatanController::class, 'delete'])->name('jabatan.delete');
});

Route::prefix("berita")->group(function () {
    Route::get('add', [BeritaController::class, 'create'])->name('berita.add');
    Route::post('store', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('edit/{id}', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::post('update/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::post('delete/{id}', [BeritaController::class, 'delete'])->name('berita.delete');
});

Route::prefix("pengumuman")->group(function () {
    Route::get('add', [PengumumanController::class, 'create'])->name('pengumuman.add');
    Route::post('store', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::get('/', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::get('edit/{id}', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
    Route::post('update/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::post('delete/{id}', [PengumumanController::class, 'delete'])->name('pengumuman.delete');
});

Route::prefix("role")->group(function () {
    Route::get('add', [RoleController::class, 'create'])->name('role.add');
    Route::post('store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/', [RoleController::class, 'index'])->name('role.index');
    Route::get('edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::post('delete/{id}', [RoleController::class, 'delete'])->name('role.delete');
});

Route::prefix("users")->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::post('delete/{id', [UserController::class, 'delete'])->name('users.delete');
});

Route::prefix("bidang")->group(function(){
    Route::get('add', [BidangController::class, 'create'])->name('bidang.add');
    Route::post('store', [BidangController::class, 'store'])->name('bidang.store');
    Route::get('/', [BidangController::class, 'index'])->name('bidang.index');
    Route::get('edit/{id}', [BidangController::class, 'edit'])->name('bidang.edit');
    Route::post('update/{id}', [BidangController::class, 'update'])->name('bidang.update');
    Route::post('delete/{id}', [BidangController::class, 'delete'])->name('bidang.delete');
});

Route ::prefix("profile")->group(function(){
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
});

Route::prefix("shift")->group(function(){
    Route::get('add', [ShiftController::class, 'create'])->name('shift.add');
    Route::post('store', [ShiftController::class, 'store'])->name('shift.store');
    Route::get('/', [ShiftController::class, 'index'])->name('shift.index');
    Route::get('edit/{id}', [ShiftController::class, 'edit'])->name('shift.edit');
    Route::post('update/{id}', [ShiftController::class, 'update'])->name('shift.update');
    Route::post('delete/{id}', [ShiftController::class, 'delete'])->name('shift.delete');
});

Route::prefix("lokasi")->group(function(){
    Route::get('add', [LokasiController::class, 'create'])->name('lokasi.add');
    Route::post('store', [LokasiController::class, 'store'])->name('lokasi.store');
    Route::get('/', [LokasiController::class, 'index'])->name('lokasi.index');
    Route::get('edit/{id}', [LokasiController::class, 'edit'])->name('lokasi.edit');
    Route::post('update/{id}', [LokasiController::class, 'update'])->name('lokasi.update');
    Route::post('delete/{id}', [LokasiController::class, 'delete'])->name('lokasi.delete');
});