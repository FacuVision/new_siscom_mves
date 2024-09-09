<?php

use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\ProviderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;

Route::get('/', [HomeController::class,"index"])->name("admin.index");

Route::resource('areas', AreaController::class)->names("admin.areas");
    Route::get("listar_areas", [AreaController::class , "listar_areas"])->name("admin.areas.listar_areas");
    /* Notas:
    - function show($id) - Se está reutilizando para reactivar un area */

Route::resource('providers', ProviderController::class)->names("admin.providers");
    Route::get("listar_providers", [ProviderController::class , "listar_providers"])->name("admin.providers.listar_providers");
    /* Notas:
    - function show($id) - Se está reutilizando para reactivar un proveedor */
