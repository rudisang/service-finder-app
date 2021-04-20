<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use App\Models\Service;

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
    $services = Service::all();
    return view('welcome')->with('services', $services);
});

Route::get('/service/book/{id}', [DashboardController::class, 'bookingForm']);
Route::post('/service/book/{id}', [DashboardController::class, 'book']);
Route::delete('/cancel/booking/{id}', [DashboardController::class, 'cancelBooking']);
Route::patch('/service/book/approve/{id}', [DashboardController::class, 'approveBooking']);
Route::get('/dashboard/bookings/', [DashboardController::class, 'allBookings']);

Route::get('/search', [ServiceController::class, 'search']);
Route::post('/rate', [ServiceController::class, 'rate']);
Route::post('/dashboard/create-service', [DashboardController::class, 'storeNewService']);
Route::get('/dashboard/create-service', [DashboardController::class, 'createNewService']);
Route::post('/dashboard/create-user', [DashboardController::class, 'storeNewUser']);
Route::get('/dashboard/create-user', [DashboardController::class, 'createUser']);
Route::get('/dashboard/account', [DashboardController::class, 'editAccount']);

Route::patch('service/edit/{id}', [DashboardController::class, 'updateService']);
Route::patch('service/images/{id}', [DashboardController::class, 'updateServiceImages']);
Route::get('/dashboard/account/service/{id}', [DashboardController::class, 'editService']);
Route::get('/dashboard/account/user/{id}', [DashboardController::class, 'editUser']);
Route::delete('/dashboard/account/user/{id}', [DashboardController::class, 'deleteUser']);
Route::patch('/dashboard/account/update-password/{id}', [DashboardController::class, 'updatePassword']);
Route::patch('/dashboard/account/update-details/{id}', [DashboardController::class, 'updateDetails']);
Route::resource('/dashboard', DashboardController::class);

Route::resource('/services', ServiceController::class);

require __DIR__.'/auth.php';
