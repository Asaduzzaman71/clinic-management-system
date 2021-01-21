<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\BloodController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AppointmentController;


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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');



Route::get('/admin/edit/{admin}', [AdminController::class,'edit'])->name('admin.edit');
Route::put('/admin/{admin}', [AdminController::class,'update'])->name('admin.update');
Route::get('/admin/{admin}', [AdminController::class,'show'])->name('admin.show');


Route::resource('departments', DepartmentController::class);
Route::resource('facilities', FacilityController::class);
Route::resource('doctors', DoctorController::class);
Route::resource('bloods', BloodController::class);
Route::resource('patients', PatientController::class);
Route::resource('schedules', ScheduleController::class);


Route::resource('appointments', AppointmentController::class);
Route::get('appointments/view/{appointment}',[AppointmentController::class,'getRequestedAppointments'])->name('appointments.requested');
Route::get('appointments/reuested/{doctor}',[AppointmentController::class,'getRequestedAppointments'])->name('appointments.requested');
Route::get('appointments/approve/{appointment}',[AppointmentController::class,'approveAppointments'])->name('appointments.approve');
Route::get('appointments/approved/{doctor}',[AppointmentController::class,'getApprovedAppointments'])->name('appointments.approved');


Route::get('/findDoctorName',[ScheduleController::class,'getDoctor']);
Route::get('/getAppointmentDetails',[AppointmentController::class,'appointmentDetails']);
Route::get('/checkAppointmentAvailability',[AppointmentController::class,'checkAvailability']);

// Route::get('/login', [LoginController::class, 'index'])->name('login');
// Route::post('/login', [LoginController::class, 'authenticate']);
//Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
