<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClinicController;
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



Route::prefix('cms')->middleware('guest:admin')->group(function(){
    Route::get('{guard}/login',[AuthController::class,'ShowLogin'])->name('auth.login.view');
    Route::post('login',[AuthController::class, 'Login'])->name('auth.login');

});



route::prefix('cms/admin')->middleware('auth:admin')->group(function(){
    route::resource('roles',RoleController::class);
    route::resource('permissions',PermissionController::class);
    route::put('roles/{role}/permissions',[RolePermissionController::class,'update'])->name('rindexole-permission.update');
});

route::prefix('cms/admin')->middleware('auth:admin')->group(function(){
    Route::view('/','cms.parent');
    route::resource('admins',AdminController::class);
    route::resource('clinics',ClinicController::class);

    /*************** logout ***************/
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});
