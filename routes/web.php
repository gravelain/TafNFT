<?php

use App\Models\Nft;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\NftController;
=======
>>>>>>> 5797d40 (changement locaux)
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
Route::middleware(['auth','admin'])->group(function () {
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        // route admin authentifié
<<<<<<< HEAD:nftMarket/routes/web.php
        Route::get('/home', [DashboardController::class, 'index'])->name('home');
        Route::post('/store-nft', [NftController::class, 'store'])->name('store.nft');
=======
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
>>>>>>> ad29e6c (add new file):routes/web.php
    });

    Route::middleware('role:user')->group(function () {
        // route user authentifié
        Route::get('/home', [HomeController::class, 'index'])->name('home');
    });


    Route::middleware('role:admin,user')->group(function () {
        Route::get('/nfts', [NftController::class, 'index'])->name('all.nfts');
        Route::get('/one-nft', [NftController::class, 'show'])->name('one.nfts');
    });
});

Auth::routes();
