<?php
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

 // Route d'accueil, qui liste tous les NFT
 Route::get('/', function () {
    return view('nfts/nfts');
});



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
