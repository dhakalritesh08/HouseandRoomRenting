<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PropertyController;




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

Route::get('/', function () {
    return view('welcome');
});

//Login Register Route
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'registerPost']);

    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'loginPost'])->name('login');
});

//Logout Route
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'user_type:admin,landlord'])->group(function () {
    Route::get('/admin_dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

//user Management Routes
Route::middleware(['auth', 'user_type:admin'])->group(function () {
Route::get('/user_management', [UserController::class, 'index'])->name('admin.user.management');
Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});



// User Route
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});

// Admin Properties
Route::middleware(['auth', 'user_type:admin,landlord'])->group(function () {
Route::get('/admin/properties', [PropertyController::class, 'index'])->name('admin.properties.index');
Route::get('/admin/properties/create', [PropertyController::class, 'create'])->name('admin.properties.create');
Route::post('/admin/properties', [PropertyController::class, 'store'])->name('admin.properties.store');
Route::get('/admin/properties/{property}', [PropertyController::class, 'show'])->name('admin.properties.show');
Route::get('/admin/properties/{property}/edit', [PropertyController::class, 'edit'])->name('admin.properties.edit');
Route::put('/admin/properties/{property}', [PropertyController::class, 'update'])->name('admin.properties.update');
Route::delete('/admin/properties/{property}', [PropertyController::class, 'destroy'])->name('admin.properties.destroy');
});
