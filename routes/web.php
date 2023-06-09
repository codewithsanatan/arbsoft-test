<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthController;

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
    return view('welcome');
});

Route::get('registration', [CustomAuthController::class, 'registration'])->name('register.user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
Route::post('update-user', [CustomAuthController::class, 'updateUser'])->name('update.user');
Route::post('delete-user', [CustomAuthController::class, 'deleteUser'])->name('delete.user');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
