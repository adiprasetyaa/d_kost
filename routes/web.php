<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController; 

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.index');
        Route::get('/admin/logout',[AdminController::class, 'adminLogout'])->name('admin.logout');

        Route::controller(UserController::class)->group(function(){
            Route::get('/admin/user', 'index')->name('admin.user.index');
            Route::get('/admin/user/create', 'create')->name('admin.user.create');
            Route::get('/admin/user/show/{user_id}','show')->name('admin.user.show');
            Route::post('/admin/user/store', 'store')->name('admin.user.store');
            Route::get('/admin/user/edit/{user_id}', 'edit')->name('admin.user.edit');
            Route::put('/admin/user/update/{user_id}', 'update')->name('admin.user.update');
            Route::delete('admin/user/delete/{user_id}','destroy')->name('admin.user.delete');
        });

        Route::controller(RoomController::class)->group(function(){
            Route::get('/admin/room', 'index')->name('admin.room.index');
            Route::get('/admin/room/create', 'create')->name('admin.room.create');
            Route::get('/admin/room/show/{room_id}','show')->name('admin.room.show');
            Route::post('/admin/room/store', 'store')->name('admin.room.store');
            Route::get('/admin/room/edit/{room_id}', 'edit')->name('admin.room.edit');
            Route::put('/admin/room/update/{room_id}', 'update')->name('admin.room.update');
            Route::delete('admin/room/delete/{room_id}','destroy')->name('admin.room.delete');
        });

        Route::controller(ReservationController::class)->group(function(){
            Route::get('/admin/reservation', 'index')->name('admin.reservation.index');
            Route::get('/admin/reservation/create', 'create')->name('admin.reservation.create');
            Route::get('/admin/reservation/show/{reservation_id}','show')->name('admin.reservation.show');
            Route::post('/admin/reservation/store', 'store')->name('admin.reservation.store');
            Route::get('/admin/reservation/edit/{reservation_id}', 'edit')->name('admin.reservation.edit');
            Route::put('/admin/reservation/update/{reservation_id}', 'update')->name('admin.reservation.update');
            Route::delete('admin/reservation/delete/{reservation_id}','destroy')->name('admin.reservation.delete');
        });
}); 

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard',[UserController::class,'userDashboard'])->name('user.index');
    Route::get('/user/logout',[UserController::class, 'userLogout'])->name('user.logout');

    Route::controller(RoomController::class)->group(function(){
        Route::get('/user/room', 'listRoom')->name('user.list.room');
        Route::get('/user/room/create/{room_id}','createRoom')->name('user.create.room');
    });

    Route::controller(ReservationController::class)->group(function(){
        Route::post('/user/reservation/store/{room_id}', 'storeReservation')->name('user.reservation.store');
    });
}); 

Route::get('admin/login',[AdminController::class, 'adminLogin'])->name('admin.login');
Route::get('user/login',[UserController::class, 'userLogin'])->name('user.login');