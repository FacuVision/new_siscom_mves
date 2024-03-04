<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});


// Route::get('/dashboard', function () {
//     // Verifica si el usuario tiene el campo 'estado' activo
//     if (Auth::check() && Auth::user()->estado === 'activo') {
//         // Lógica para usuarios activos
//         return view('admin.index');
//     } else {
//         // Si el usuario no tiene el campo 'estado' activo, lo redirige al welcome
//         return redirect('/');
//     }
// })->name('dashboard');
