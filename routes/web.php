<?php

use App\Http\Controllers\BidangController;
use App\Http\Controllers\BulananController;
use App\Http\Controllers\ConfirmController;
use App\Http\Controllers\KaryawanDBController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\TotalController;
use App\Http\Controllers\UserController;
use Illuminate\Console\View\Components\Confirm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\HarianController;

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

// PUBLIC
Route::get('/', [LandingController::class, 'index'])->name('landing.home')->middleware('guest');
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/ceklogin', [AuthController::class, 'ceklogin'])->name('ceklogin');
Route::get('/profilekph', [LandingController::class, 'profile'])->name('profile')->middleware('guest');
Route::get('/visimisikph', [LandingController::class, 'visimisi'])->name('visimisi')->middleware('guest');
Route::get('/beritakph', [LandingController::class, 'berita'])->name('berita')->middleware('guest');
Route::get('/fitur', [LandingController::class, 'fitur'])->name('fitur')->middleware('guest');
Route::get('/datakaryawankph', [LandingController::class, 'datakaryawan'])->name('datakaryawan')->middleware('guest');
Route::get('/strukturkph', [LandingController::class, 'struktur'])->name('struktur')->middleware('guest');

// ALL ROLES

Route::middleware('check.role:Admin,Karyawan,Pimpinan,Mahasiswa')->group(function () {
    Route::get('/home', [NavController::class, 'dashboard'])->name('dashboard');
    Route::get('/get_pengumuman', [PengumumanController::class, 'get_pengumuman'])->name('get_pengumuman');


    Route::prefix("profile")->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('update-profile-picture', [ProfileController::class, 'updateProfilePicture'])
            ->name('profile.updateProfilePicture');
        Route::post('update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    });

    Route::prefix("data")->group(function () {
        Route::get('add', [DataController::class, 'create'])->name('data.add');
        Route::post('store', [DataController::class, 'store'])->name('data.store');
        Route::get('/', [DataController::class, 'index'])->name('data.index');
        Route::delete('delete/{id}', [DataController::class, 'delete'])->name('data.delete');
    });
});

Route::middleware('check.role:Admin,Mahasiswa')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/registered', [AuthController::class, 'registered'])->name('registered');

    Route::prefix("wilayah")->group(function () {
        Route::get('add', [WilayahController::class, 'create'])->name('wilayah.add');
        Route::post('store', [WilayahController::class, 'store'])->name('wilayah.store');
        Route::get('/', [WilayahController::class, 'index'])->name('wilayah.index');
        Route::get('edit/{id}', [WilayahController::class, 'edit'])->name('wilayah.edit');
        Route::post('update/{id}', [WilayahController::class, 'update'])->name('wilayah.update');
        Route::delete('delete/{id}', [WilayahController::class, 'delete'])->name('wilayah.delete');
    });

    Route::prefix("jabatan")->group(function () {
        Route::get('add', [JabatanController::class, 'create'])->name('jabatan.add');
        Route::post('store', [JabatanController::class, 'store'])->name('jabatan.store');
        Route::get('/', [JabatanController::class, 'index'])->name('jabatan.index');
        Route::get('edit/{id}', [JabatanController::class, 'edit'])->name('jabatan.edit');
        Route::post('update/{id}', [JabatanController::class, 'update'])->name('jabatan.update');
        Route::post('restore/{id}', [JabatanController::class, 'restore'])->name('jabatan.restore');
        Route::delete('delete/{id}', [JabatanController::class, 'delete'])->name('jabatan.delete');
    });

    Route::prefix("berita")->group(function () {
        Route::get('/', [BeritaController::class, 'index'])->name('berita.index');
        Route::get('add', [BeritaController::class, 'create'])->name('berita.add');
        Route::post('store', [BeritaController::class, 'store'])->name('berita.store');
        Route::get('edit/{id}', [BeritaController::class, 'edit'])->name('berita.edit');
        Route::post('update/{id}', [BeritaController::class, 'update'])->name('berita.update');
        Route::post('restore/{id}', [BeritaController::class, 'restore'])->name('berita.restore');
        Route::delete('delete/{id}', [BeritaController::class, 'delete'])->name('berita.delete');
    });

    Route::prefix("pengumuman")->group(function () {
        Route::get('add', [PengumumanController::class, 'create'])->name('pengumuman.add');
        Route::post('store', [PengumumanController::class, 'store'])->name('pengumuman.store');
        Route::get('/', [PengumumanController::class, 'index'])->name('pengumuman.index');
        Route::get('edit/{id}', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
        Route::post('update/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
        Route::post('restore/{id}', [PengumumanController::class, 'restore'])->name('pengumuman.restore');
        Route::delete('delete/{id}', [PengumumanController::class, 'delete'])->name('pengumuman.delete');
    });

    Route::prefix("role")->group(function () {
        Route::get('add', [RoleController::class, 'create'])->name('role.add');
        Route::post('store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('delete/{id}', [RoleController::class, 'delete'])->name('role.delete');
    });

    Route::prefix("users")->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('restore/{id}', [UserController::class, 'restore'])->name('users.restore');
        Route::delete('delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    });

    Route::prefix("bidang")->group(function () {
        Route::get('add', [BidangController::class, 'create'])->name('bidang.add');
        Route::post('store', [BidangController::class, 'store'])->name('bidang.store');
        Route::get('/', [BidangController::class, 'index'])->name('bidang.index');
        Route::get('edit/{id}', [BidangController::class, 'edit'])->name('bidang.edit');
        Route::post('update/{id}', [BidangController::class, 'update'])->name('bidang.update');
        Route::delete('delete/{id}', [BidangController::class, 'delete'])->name('bidang.delete');
        Route::post('restore/{id}', [BidangController::class, 'restore'])->name('bidang.restore');
    });

    Route::prefix("shift")->group(function () {
        Route::get('add', [ShiftController::class, 'create'])->name('shift.add');
        Route::post('store', [ShiftController::class, 'store'])->name('shift.store');
        Route::get('/', [ShiftController::class, 'index'])->name('shift.index');
        Route::get('edit/{id}', [ShiftController::class, 'edit'])->name('shift.edit');
        Route::post('update/{id}', [ShiftController::class, 'update'])->name('shift.update');
        Route::delete('delete/{id}', [ShiftController::class, 'delete'])->name('shift.delete');
        Route::post('restore/{id}', [ShiftController::class, 'restore'])->name('shift.restore');
    });

    Route::prefix("lokasi")->group(function () {
        Route::get('add', [LokasiController::class, 'create'])->name('lokasi.add');
        Route::post('store', [LokasiController::class, 'store'])->name('lokasi.store');
        Route::get('/', [LokasiController::class, 'index'])->name('lokasi.index');
        Route::get('edit/{id}', [LokasiController::class, 'edit'])->name('lokasi.edit');
        Route::post('update/{id}', [LokasiController::class, 'update'])->name('lokasi.update');
        Route::delete('delete/{id}', [LokasiController::class, 'delete'])->name('lokasi.delete');
        Route::post('restore/{id}', [LokasiController::class, 'restore'])->name('lokasi.restore');
    });

    Route::prefix("karyawan")->group(function () {
        Route::get('add', [KaryawanDBController::class, 'create'])->name('karyawan.add');
        Route::post('store', [KaryawanDBController::class, 'store'])->name('karyawan.store');
        Route::get('/', [KaryawanDBController::class, 'index'])->name('karyawan.index');
        Route::get('edit/{id}', [KaryawanDBController::class, 'edit'])->name('karyawan.edit');
        Route::post('update/{id}', [KaryawanDBController::class, 'update'])->name('karyawan.update');
        Route::post('restore/{id}', [KaryawanDBController::class, 'restore'])->name('karyawan.restore');
        Route::delete('delete/{id}', [KaryawanDBController::class, 'delete'])->name('karyawan.delete');
    });

    Route::prefix("harian")->group(function () {
        Route::get('/', [HarianController::class, 'index'])->name('harian.index');
        Route::get('updatePoinFromData', [HarianController::class, 'updatePoinFromData'])->name('harian.updatePoinFromData');
        Route::get('/poin/{idUser}', [HarianController::class, 'getPoinByUser']);
    });

    Route::prefix("confirm")->group(function () {
        Route::get('/', [ConfirmController::class, 'index'])->name('confirm.index');
        Route::delete('delete/{id}', [ConfirmController::class, 'delete'])->name('confirm.delete');
    });
});

Route::middleware('check.role:Admin,Pimpinan,Mahasiswa')->group(function () {
    Route::get('/bulanan', [BulananController::class, 'index'])->name('bulanan');
    Route::get('/total', [TotalController::class, 'index'])->name('total');
    Route::post('proses-approval/{id}/{status}', [ConfirmController::class, 'approval'])->name('approval.process');

});