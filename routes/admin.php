<?php

use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\ContractTypeController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\ProviderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', [HomeController::class,"index"])->name("admin.index");

Route::resource('areas', AreaController::class)->names("admin.areas");
    Route::get("listar_areas", [AreaController::class , "listar_areas"])->name("admin.areas.listar_areas");
    /* Notas:
    - function show($id) - Se está reutilizando para reactivar un area */

Route::resource('providers', ProviderController::class)->names("admin.providers");
    Route::get("listar_providers", [ProviderController::class , "listar_providers"])->name("admin.providers.listar_providers");
    /* Notas:
    - function show($id) - Se está reutilizando para reactivar un proveedor */

Route::resource('contract_types', ContractTypeController::class)->names("admin.contracts");
    Route::get("listar_contracts", [ContractTypeController::class , "listar_contracts"])->name("admin.contracts.listar_contracts");
    /* Notas:
    - function show($id) - Se está reutilizando para reactivar un tipo de contrato */

Route::resource('document_types', DocumentTypeController::class)->names("admin.documents");
    Route::get("listar_documents", [DocumentTypeController::class , "listar_documents"])->name("admin.documents.listar_documents");
    /* Notas:
    - function show($id) - Se está reutilizando para reactivar un tipo de documento */

Route::resource('users', UserController::class)->names('admin.users');
Route::get("listar_usuarios", [UserController::class , "listar_usuarios"])->name("admin.users.listar_usuarios");
Route::get("admin.users.listar_roles", [UserController::class , "listar_roles"])->name("admin.users.listar_roles");
    /* Notas:
    - function show($id) - Se está reutilizando para reactivar un usuario */
