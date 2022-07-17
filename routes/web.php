<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
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
    return view('welcome');
});



Route::prefix('cms')->middleware('guest:admin,doctor,patient,employee')->group(function(){
    Route::get('{guard}/login',[AuthController::class,'ShowLogin'])->name('auth.login.view');
    Route::post('login',[AuthController::class, 'Login'])->name('auth.login');

});



route::prefix('cms/admin')->middleware('auth:admin,doctor,patient,employee')->group(function(){
    route::resource('roles',RoleController::class);
    route::resource('permissions',PermissionController::class);
    route::put('roles/{role}/permissions',[RolePermissionController::class,'update'])->name('rindexole-permission.update');
});

route::prefix('cms/admin')->middleware('auth:admin,doctor,patient,employee')->group(function(){
    Route::view('/','cms.parent');
    route::resource('admins',AdminController::class);
    route::resource('clinics',ClinicController::class);
    route::resource('doctors',DoctorController::class);
    route::resource('patients',PatientController::class);
    route::resource('bookings',BookingController::class);
    route::resource('employees',EmployeeController::class);

    /*************** edit and update password ***************/
    Route::get('edit-password', [AuthController::class, 'editPassword'])->name('auth.edit-password');
    Route::put('update-password', [AuthController::class, 'updatePassword']);

    /*************** edit and update profile ***************/
    Route::get('edit-profile', [AuthController::class, 'editProfile'])->name('auth.edit-profile');
    Route::put('update-profile', [AuthController::class, 'updateProfile']);



    /*************** logout ***************/
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});
