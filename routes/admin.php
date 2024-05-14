<?php

use App\Http\Controllers\Admin\AreaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;

Route::get('/', [HomeController::class,"index"])->name("admin.index");

Route::resource('areas', AreaController::class)->names("admin.areas");
    Route::get("listar_areas", [AreaController::class , "listar_areas"])->name("admin.areas.listar_areas");
    /* Notas:
    - function show($id) - Se está reutilizando para reactivar un area */

