<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckRoleAdminMiddleware;
use Illuminate\Support\Facades\Auth;
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


// Route::get('login', [AuthController::class, 'showFormLogin']);
// Route::post('login', [AuthController::class, 'login'])->name('login');

// Route::get('register', [AuthController::class, 'showFormRegister']);
// Route::post('register', [AuthController::class, 'register'])->name('register');

// Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/home', function () {
//     return view('home');
// })->middleware('auth');

// Route::get('/admin', function () {
//     return 'Đây là trang Admin';
// })->middleware(['auth', 'auth.admin']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route Admin
Route::middleware(['auth', 'auth.admin'])->prefix('admins')
    ->as('admins.')
    ->group(function () {

        Route::get('/', function () {
            return view('admins.dashbroad');
        })->name('dashbroad');
 
        Route::prefix('categories')
            ->as('categories.')
            ->group(function () {
                Route::get('/', [CategoryController::class, 'index'])->name('index');
                Route::get('/create', [CategoryController::class, 'create'])->name('create');
                Route::post('/store', [CategoryController::class, 'store'])->name('store');
                Route::get('/show/{id}', [CategoryController::class, 'show'])->name('show');
                Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [CategoryController::class, 'update'])->name('update');
                Route::delete('{id}/delete', [CategoryController::class, 'destroy'])->name('delete');
            });
    });