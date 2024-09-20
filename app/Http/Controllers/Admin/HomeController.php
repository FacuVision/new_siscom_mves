<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\ContractType;
use App\Models\DocumentType;
use App\Models\Provider;

class HomeController extends Controller
{
    public function index()
    {
        $cant_unidades = Area::select("id")->count();
        $cant_contracts = ContractType::select("id")->count();
        $cant_providers = Provider::select("id")->count();
        $cant_documents = DocumentType::select("id")->count();

        $conteo = [
            "unidades" => $cant_unidades,
            "contratos" => $cant_contracts,
            "proveedores" => $cant_providers,
            "tipos_documentos" => $cant_documents
        ];
        return view("admin.index", compact("conteo"));
    }
}
