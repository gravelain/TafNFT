<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
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


// route user non authentifié
// Route d'accueil, qui liste tous les NFT
Route::get('/', function () {
    return view('nfts/nfts');
});


// route authentifi 
Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        // route admin authentifié
        Route::get('/home', [DashboardController::class, 'index'])->name('home');
    });

    Route::middleware('role:user')->group(function () {
        // route user authentifié
        Route::get('/home', [HomeController::class, 'index'])->name('home');
    });
});

Auth::routes();
