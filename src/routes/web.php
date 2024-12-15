<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
// use Laravel\Fortify\Fortify;

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
Route::get('/', [ContactController::class, 'create']);
Route::get('/register', [UserController::class, 'index']);
Route::post('/register', [UserController::class, 'store']);
Route::get('/logout', function () {Auth::logout();return redirect('/login');})->name('logout.get');
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);
Route::delete('/admin/{contactId}', [ContactController::class, 'destroy'])->name('admin.destroy');
Route::get('/admin', [ContactController::class, 'index'])->middleware('auth');
Route::get('/admin/search', [ContactController::class, 'search']);


