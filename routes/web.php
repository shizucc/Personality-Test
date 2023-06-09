<?php


use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\Pakar\KepribadianController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Pakar\PakarController as PakarController;
use App\Http\Controllers\Pakar\CiriController as PakarCiriController;
use App\Http\Controllers\Pakar\KepribadianController as PakarKepribadianController;
use App\Http\Controllers\Pakar\PertanyaanController as PakarPertanyaanController;
use App\Http\Controllers\Pakar\HistoriController as PakarHistoriController;

use App\Http\Controllers\Admin\AdminController as AdminController;
use App\Http\Controllers\Admin\UserContoller as AdminUserContoller;
use App\Http\Controllers\Admin\PakarContoller as AdminPakarContoller;
use App\Http\Controllers\Admin\HistoriController as AdminHistoriController;

Route::get('/', [DiagnosaController::class, 'index'])->name('home');
Route::get('/tentang_kami', function (){return Inertia::render('Tentang_kami');})->name('tentang_kami');

// Halaman Diagnosa
Route::get('/diagnosa', [DiagnosaController::class, 'notice'])->name('diagnosa.start');
Route::get('/diagnosa/pertanyaan', [DiagnosaController::class, 'pertanyaan'])->name('diagnosa.pertanyaan');
Route::post('/diagnosa/hasil', [DiagnosaController::class, 'perhitungan'])->name('diagnosa.perhitungan');
Route::get('/diagnosa/hasil-{user_id}-{diagnosa_id}', [DiagnosaController::class, 'hasil'])->name('diagnosa.hasil');

Route::middleware(['auth', 'verified'])->group(function () {
    // User
    Route::get('/histori', [ProfileController::class, 'histori'])->name('profile.histori');

    // Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    // Route::get('/manajemenpakar', function (){return Inertia::render('Admin/ManajemenPakar');})->name('admin.manajemenpakar');
    // Route::get('/manajemenuser', function (){return Inertia::render('Admin/ManajemenUser');})->name('admin.manajemenuser');
    // Route::get('/historidiagnosa', function (){return Inertia::render('Admin/HistoriDiagnosa');})->name('admin.historidiagnosa');
    //-- Form
    // Route::get('/tambahuser', function (){return Inertia::render('Admin/TambahUser');})->name('admin.manajemenuser');
    // Pakar
    Route::get('/pakar', [PakarController::class,'index'])->name('pakar.index');

    Route::resource('pakar/kepribadian', PakarKepribadianController::class)->except('update')->names([
        'index' => 'pakar.kepribadian.index',
        'create' => 'pakar.kepribadian.create',
        'store' => 'pakar.kepribadian.store',
        'show' => 'pakar.kepribadian.show',
        'edit' => 'pakar.kepribadian.edit',
        'destroy' => 'pakar.kepribadian.destroy',
    ]);

    // Route::post('/pakar/kepribadian', [PakarKepribadianController::class, 'update'])->name('pakar.kepribadian.update');

    Route::resource('pakar/ciri', PakarCiriController::class)->names([
        'index' => 'pakar.ciri.index',
        'create' => 'pakar.ciri.create',
        'store' => 'pakar.ciri.store',
        'edit' => 'pakar.ciri.edit',
        'update' => 'pakar.ciri.update',
        'destroy' => 'pakar.ciri.destroy',
    ])->except('show');

    Route::resource('pakar/pertanyaan', PakarPertanyaanController::class)->names([
        'index' => 'pakar.pertanyaan.index',
        'create' => 'pakar.pertanyaan.create',
        'store' => 'pakar.pertanyaan.store',
        'edit' => 'pakar.pertanyaan.edit',
        'update' => 'pakar.pertanyaan.update',
        'destroy' => 'pakar.pertanyaan.destroy',
    ])->except('show');


    Route::resource('/pakar/histori', PakarHistoriController::class)->only('index', 'show')->names([
        'index' => 'pakar.histori.index',
        'show' => 'pakar.histori.show',
    ]);

    Route::resource('/admin/user', AdminUserContoller::class)->except('show')->names([
        'index' => 'admin.user.index',
        'create' => 'admin.user.create',
        'store' => 'admin.user.store',
        'edit' => 'admin.user.edit',
        'update' => 'admin.user.update',
        'destroy' => 'admin.user.destroy',
    ]);
    Route::resource('/admin/pakar', AdminPakarContoller::class)->except('show')->names([
        'index' => 'admin.pakar.index',
        'create' => 'admin.pakar.create',
        'store' => 'admin.pakar.store',
        'edit' => 'admin.pakar.edit',
        'update' => 'admin.pakar.update',
        'destroy' => 'admin.pakar.destroy',
    ]);

    Route::resource('/admin/histori', AdminHistoriController::class)->only('index','show')->names([
        'index' => 'admin.histori.index',
        'show' => 'admin.histori.show',
    ]);
    Route::delete('/admin/histori/delete-{user_id}-{diagnosa_id}', [AdminHistoriController::class, 'destroy'])->name(
        'admin.histori.destroy'
    );

    // Route::get('/pakar/manajemenkepribadian', function (){return Inertia::render('Pakar/ManajemenKepribadian');})->name('pakar.manajemenkepribadian');
    //Route::get('/pakar/manajemenciriciri', [PakarController::class,'ciri_ciri'])->name('pakar.manajemenciriciri');
    // Route::get('/manajemenpertanyaan', function (){return Inertia::render('Pakar/ManajemenPertanyaan');})->name('pakar.manajemenpertanyaan');
    // Route::get('/historidiagnosapkr', function (){return Inertia::render('Pakar/HistoriDiagnosa');})->name('pakar.historidiagnosa');

});



Route::get('/sidebar', function (){return Inertia::render('Admin/SidebarAdmin');});



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';
