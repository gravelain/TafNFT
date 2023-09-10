<?php

use App\Models\Nft;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NftController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

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


// route user non authentifié
// Route d'accueil, qui liste tous les NFT
Route::get('/', function () {
    $nfts = Nft::all();
    return view('nfts/nfts')->with('nfts', $nfts);
});


// route authentifi 
Route::middleware(['auth','redirect.admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        // route admin authentifié
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/home', [DashboardController::class, 'index'])->name('home');
        Route::post('/store-nft', [NftController::class, 'store'])->name('nfts.store');
        Route::get('/list-users',[DashboardController::class, 'getUsers'])->name('users.index');
        Route::get('/list-nfts',[DashboardController::class, 'getNft'])->name('nfts.index');
        Route::delete('/list-nfts/{id}',[NftController::class, 'destroy'])->name('nfts.delete');
    });
});

Route::middleware(['auth','role:admin,user'])->group(function () {
    Route::get('/nfts', [NftController::class, 'index'])->name('all.nfts');
    Route::get('/one-nft', [NftController::class, 'show'])->name('one.nfts');
});

Route::middleware(['auth','role:user'])->group(function () {
    // route user authentifié
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Auth::routes();
