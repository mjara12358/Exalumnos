<?php

use App\Http\Controllers\CustomRegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExalumnosController;
use App\Http\Controllers\RegistroExalumnosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seguridad\PermisosController;
use App\Http\Controllers\Seguridad\RolesController;
use App\Http\Controllers\UsuariosController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', [CustomRegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [CustomRegisteredUserController::class, 'store']);

Route::get('/register-exalumno', [RegistroExalumnosController::class, 'create'])->name('register-exalumno');
Route::post('/register-exalumno', [RegistroExalumnosController::class, 'store']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('permisos', PermisosController::class);

    Route::resource('roles', RolesController::class);

    Route::resource('users', UsuariosController::class);

    Route::resource('exalumnos', ExalumnosController::class);

});
