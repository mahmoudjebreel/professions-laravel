<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\UserAuthController;
use App\Models\Speciality;
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

Route::prefix('cms')->middleware('guest:admin,professional')->group(function () {
    Route::get('{guard}/login', [UserAuthController::class, 'showLogin'])->name('cms.login');
    Route::post('{guard}/login', [UserAuthController::class, 'login']);
});

Route::prefix('cms/admin')->middleware('auth:admin,professional')->group(function () {
    Route::view('/', 'cms.temp');

    Route::get('password/edit', [UserAuthController::class, 'editPassword'])->name('cms.auth.edit-password');
    Route::put('password/update', [UserAuthController::class, 'updatePassword'])->name('cms.auth.update-password');
    Route::get('logout', [UserAuthController::class, 'logout'])->name('cms.auth.logout');
});

Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {
    Route::resource('specialities', SpecialityController::class);
    Route::resource('cities', CityController::class);
    Route::resource('professions', ProfessionController::class);

    Route::resource('admins', AdminController::class);
    Route::resource('professionals', ProfessionalController::class);
    Route::resource('customers', CustomerController::class);

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::resource('role.permissions', RolePermissionController::class);
});

Route::get('test', function () {
    $data = Speciality::all();
    echo $data;
});
