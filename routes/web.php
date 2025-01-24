<?php

use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuscripcionController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagoController;

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
    

    Route::get('/usuarios', function () {
        return view('usuarios.index');
    });
    
    Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::put('/usuarios/{usuario}', [UsuarioController::class, 'delete'])->name('usuarios.delete');
    
    
    Route::get('/planes', function () {
        return view('planes.index');
    });
    
    Route::put('/planes/{plan}', [PlanController::class, 'update'])->name('planes.update');
    Route::put('/planes/{plan}', [PlanController::class, 'delete'])->name('planes.delete');
    
    Route::get('/suscripciones', function () {
        return view('suscripciones.index');
    });

    Route::put('/suscripciones/{suscripcion}', [SuscripcionController::class, 'update'])->name('suscripciones.update');
    Route::put('/suscripciones/{suscripcion}', [SuscripcionController::class, 'delete'])->name('suscripciones.delete');



    Route::resource('pagos', PagoController::class);



});

require __DIR__.'/auth.php';





