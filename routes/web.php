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
use App\Http\Controllers\AccountantController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DiagnosisReportController;



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
Route::resource('schedules', ScheduleController::class);
Route::resource('accountants', AccountantController::class);
Route::resource('tests', TestController::class);

Route::resource('diagnosisReports', DiagnosisReportController::class);
Route::get('diagnosisReports/createReport/{prescription}',[DiagnosisReportController::class,'createReport'])->name('diagnosis.report.create');
Route::get('diagnosisReports/download/{diagnosisReport}',[DiagnosisReportController::class,'download'])->name('diagnosis.report.download');

Route::resource('prescriptions', PrescriptionController::class);
Route::get('prescriptions/doctor/{doctor}',[PrescriptionController::class,'getPrescriptionCreatedByDoctor'])->name('prescription.doctor');
Route::get('prescriptions/patient/{patient}',[PrescriptionController::class,'getPrescriptionByPatientId'])->name('prescription.patient');


Route::resource('patients', PatientController::class);
Route::get('/liveSearch',[PatientController::class,'liveSearchPatient'])->name('liveSearch');
Route::get('/patientSearch',[PatientController::class,'searchPatient'])->name('patientSearch');



Route::resource('invoices', InvoiceController::class);
Route::post('/invoices/entry/add',[InvoiceController::class,'invoiceEntryAdd'])->name('invoice.entry.add');


Route::resource('appointments', AppointmentController::class);
Route::get('appointments/view/{appointment}',[AppointmentController::class,'getRequestedAppointments'])->name('appointments.requested');
Route::get('appointments/doctor//reuested/{doctor}',[AppointmentController::class,'getRequestedAppointments'])->name('appointments.requested');
Route::get('appointments/doctor/approve/{appointment}',[AppointmentController::class,'approveAppointments'])->name('appointments.approve');
Route::get('appointments/doctor/approved/{doctor}',[AppointmentController::class,'getApprovedAppointments'])->name('appointments.approved');
Route::get('appointments/patient/pending/{patient}',[AppointmentController::class,'getPatientPendingAppointments'])->name('appointments.pending');
Route::get('appointments/patient/accepted/{patient}',[AppointmentController::class,'getPatientAcceptedAppointments'])->name('appointments.accepted');



Route::get('/findDoctorDropdownList',[HomeController::class,'getDoctor']);
Route::get('/findDoctorName',[ScheduleController::class,'getDoctor']);

Route::get('/getAppointmentDetails',[AppointmentController::class,'appointmentDetails']);
Route::get('/checkAppointmentAvailability',[AppointmentController::class,'checkAvailability']);

// Route::get('/login', [LoginController::class, 'index'])->name('login');
// Route::post('/login', [LoginController::class, 'authenticate']);
//Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
