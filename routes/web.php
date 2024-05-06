<?php

use App\Http\Controllers\EmpleadoController;
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

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/empleado', [EmpleadoController::class, 'index']);
// Route::get('/empleado/create', [EmpleadoController::class, 'create']);
// Route::get('/empleado/edit', [EmpleadoController::class, 'edit']);
Route::resource('empleado', EmpleadoController::class)->middleware('auth'); // Es una manera de mostrar todas las solicitudes con sus rutas sin tener que poner muchas lineas 

Auth::routes(['register' =>false, 'reset'=>false]); // Quito los apartados de registro y de recuperar contraseña, esto por seguridad

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
});
