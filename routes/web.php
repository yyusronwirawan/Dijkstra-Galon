<?php

use App\Http\Controllers\DjikstraController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrafController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LahanController;
use App\Http\Controllers\LahanFrontController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\LokasiFrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TentangController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home/nodes', [HomeController::class, 'nodes'])->name('home.nodes');
Route::get('list-lokasi', [LokasiFrontController::class, 'index'])->name('lokasi.list');
Route::get('detail-lokasi/{lokasi}', [LokasiFrontController::class, 'show'])->name('lokasi.detail');
Route::get('/tentang', fn () => view('front.tentang'))->name('tentang');

/**
 *
 *
 */
Route::get('/setCurrentAsStart', [DjikstraController::class, 'setCurrentAsStart'])->name('setCurrentAsStart');
Route::get('/setStartPoint', [DjikstraController::class, 'setStartPoint'])->name('setStartPoint');
Route::get('/setEndPoint', [DjikstraController::class, 'setEndPoint'])->name('setEndPoint');
Route::get('/shortest-path', [DjikstraController::class, 'getShortestPath'])->name('getShortestPath');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile-picture', [ProfileController::class, 'updatePicture'])->name('picture.update');

    Route::resource('lokasi', LokasiController::class);

    Route::post('grafs/nodes', [GrafController::class, 'storeNode'])->name('grafs.nodes');
    Route::get('grafs/nodes', [GrafController::class, 'getNodes'])->name('grafs.nodes');
    Route::resource('grafs', GrafController::class);

    Route::prefix('users')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/', 'index')->name('users');
            Route::get('/create', 'create')->name('users.create');
            Route::get('/{id}', 'show')->name('users.show');
            Route::post('/', 'store')->name('users.store');
            Route::get('/{id}/edit', 'edit')->name('users.edit');
            Route::patch('/{id}', 'update')->name('users.update');
            Route::delete('/{id}', 'destroy');
        });
    });
});


require __DIR__ . '/auth.php';
