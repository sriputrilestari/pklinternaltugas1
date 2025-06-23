<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\MyController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;

Route::get('/', function () {
    return view('welcome');
});


//ROUTE BASIC
Route::get('about', function () {
    return 'ini Halaman About';
});

Route::get('profile', function () {
    return view('profile');
});

//ROUTE PARAMETER <ditandai dengan {}>
Route::get('produk/{namaProduk}', function ($a) {
    return 'saya membeli <b>' . $a . '</b>';
});

Route::get('beli/{barang}/{jumlah}', function ($a,$b) {
    return view('beli', compact('a' , 'b'));
});

//ROUTE OPTIONAL PARAMETER
Route::get('kategori/{namaKategori?}', function ($nama = null) {
    if($nama){
        return 'anda memilih kategori:' .$nama;
    }else {
        return 'anda belum memilih kategori!';
    }
});

Route::get('promo/{barang?}/{kode?}', function ($barang = null , $kode=null) {
    return view('promo', compact('barang' , 'kode'));
});



Route::get('siswa',[MyController::class,'index']);
Route::get('siswa/create', [MyController::class, 'create']);
Route::post('/siswa', [MyController::class, 'store']);
Route::get('siswa/{id}', [MyController::class, 'show']);
Route::get('siswa/{id}/edit', [MyController::class, 'edit']);
Route::put('siswa/{id}', [MyController::class, 'update']);
Route::delete('siswa/{id}', [MyController::class, 'destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//import middlewere
//route untuk admin / backend
Route::group(['prefix' => 'admin' , 'middleware' => ['auth', Admin::class]], function () {
    Route::get('/', [BackendController::class,'index']);
    //crud
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
});

