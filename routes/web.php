<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Owner\OwnerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Owner\OwnerAdminsController;
use App\Http\Controllers\Owner\PlayersController;
use App\Http\Controllers\Owner\RconController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/online', [StatisticsController::class, 'online'])->name('stats.online');
Route::get('/top', [StatisticsController::class, 'top'])->name('stats.top');
Route::get('/bans', [StatisticsController::class, 'bans'])->name('stats.bans');

Route::get('/staff', [AdminsController::class, 'staff'])->name('admins.staff');

Route::get('/players', [UsersController::class, 'players'])->name('users.players');
Route::get('/profile/{id}', [UsersController::class, 'profile'])->name('users.profile');

Route::prefix('settings')->middleware('auth')->group(function () {
    Route::get('/', [UsersController::class, 'settings'])->name('users.settings');
    Route::get('/username', [UsersController::class, 'settings'])->name('users.settings.username');
    Route::get('/email', [UsersController::class, 'settings'])->name('users.settings.email');
    Route::get('/password', [UsersController::class, 'settings'])->name('users.settings.password');
    Route::get('/admin', [UsersController::class, 'settings'])->middleware('admin')->name('users.settings.admin');
    Route::post('/request', [UsersController::class, 'submitRequest'])->name('users.settings.request');
});

Route::prefix('owner')->middleware('owner')->group(function () {
    Route::get('/', [OwnerController::class, 'index'])->name('owner.index');

    Route::prefix('admins')->group(function () {
        Route::get('/', [OwnerAdminsController::class, 'index'])->name('owner.admins.all');
        Route::get('/edit/{id}', [OwnerAdminsController::class, 'edit'])->name('owner.admins.edit');
        Route::post('/edit/{id}', [OwnerAdminsController::class, 'update'])->name('owner.admins.update');
        Route::get('/add', [OwnerAdminsController::class, 'add'])->name('owner.admins.add');
        Route::post('/', [OwnerAdminsController::class, 'store'])->name('owner.admins.store');
    });

    Route::prefix('players')->group(function () {
        Route::get('/', [PlayersController::class, 'index'])->name('owner.players.all');
    });

    Route::get('/player/{id}', [PlayersController::class, 'profile'])->name('owner.player.profile');

    Route::prefix('rcon')->group(function () {
        Route::get('/', [RconController::class, 'index'])->name('owner.rcon.index');
        Route::post('/', [RconController::class, 'execute'])->name('owner.rcon.execute');
    });
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
});