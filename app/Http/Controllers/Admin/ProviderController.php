<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderCreateRequest;
use App\Http\Requests\ProviderUpdateRequest;
use App\Models\Provider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.providers.index");

    }

   public function listar_providers()
    {
        $providers = Provider::select("id","bussiness_name","status")->get();

        return DataTables::of($providers)

        ->addColumn('action', function ($provider) {
            //Si el status del provider es activo se muestra la opcion de desactivar, de lo contrario se muestra para activar
            if ($provider->status == "activo") {
                return '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="' . $provider->id . '" data-toggle ="modal" data-target="#md_edit_provider" id="bt_provider_edit"> <i class="fas fa-solid fa-pen"></i> </a>'
                    . "&nbsp" . '<a id="provider_delete" href="javascript:void(0)" class="btn btn-sm btn-danger" data-id="' . $provider->id . '"><i class="fas fa-solid fa-trash"></i></a>';
            }

            else {
                return '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="' . $provider->id . '" data-toggle ="modal" data-target="#md_edit_provider" id="bt_provider_edit"> <i class="fas fa-solid fa-pen"></i> </a>'
                    . "&nbsp" . '<a id="provider_activate" href="javascript:void(0)" class="btn btn-sm btn-success" data-id="' . $provider->id . '"><i class="fas fa-solid fa-check"></i></a>';
            }
        })
        ->rawColumns(['action'])
        ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProviderCreateRequest $request)
    {
        Provider::create([
            "bussiness_name" => strtoupper($request->bussiness_name),
        ]);

        //$request = null;

        //return response()->json(['message' => 'Datos recibidos con éxito']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
            //Se está reutilizando para reactivar un area

            $provider = Provider::findOrFail($id);

            if ($provider) {
                $provider->update([
                    "status" => "activo"
                ]);
            }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($provider_id)
    {
        $provider_edit = Provider::select()->where("id", $provider_id)->get();

        return $provider_edit;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProviderUpdateRequest $request, $id)
    {

        $area = Provider::FindOrFail($id);

        $area->update([
            "bussiness_name" => strtoupper($request->bussiness_name)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $provider = Provider::findOrFail($id);

        if ($provider) {
            $provider->update([
                "status" => "inactivo"
            ]);
        }
    }
}
