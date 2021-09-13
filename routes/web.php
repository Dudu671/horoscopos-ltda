<?php

use App\Http\Controllers;
use App\Http\Controllers\HoroscopeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/horoscopes', [HoroscopeController::class, 'index'])->name('horoscopes.index');
Route::get('/horoscopes/new', [HoroscopeController::class, 'newForm'])->name('horoscopes.new')->middleware('auth');
Route::post('/horoscopes/new', [HoroscopeController::class, 'new'])->name('horoscopes.new')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
