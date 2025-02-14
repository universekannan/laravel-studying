<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});
Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('/users', [App\Http\Controllers\UserController::class, 'users'])->name('users');

Route::post('/adduser', [App\Http\Controllers\UserController::class, 'adduser'])->name('adduser');

Route::post('/updateuser', [App\Http\Controllers\UserController::class, 'updateuser'])->name('updateuser');

Route::get('/changepassword', [App\Http\Controllers\UserController::class, 'changepassword'])->name('changepassword');

Route::post('/updatepassword', [App\Http\Controllers\UserController::class, 'updatepassword'])->name('updatepassword');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');

Route::post('/updateprofile', [App\Http\Controllers\UserController::class, 'updateprofile'])->name('updateprofile');

Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');


