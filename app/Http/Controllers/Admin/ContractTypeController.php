<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContractTypeCreateRequest;
use App\Http\Requests\ContractTypeUpdateRequest;
use App\Models\ContractType;
use COM;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContractTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.contracts.index");
    }


    public function listar_contracts()
    {
        $contract_types = ContractType::select("id", "name", "status")->get();

        return DataTables::of($contract_types)

            ->addColumn('action', function ($contract_type) {
                //Si el status del contract es activo se muestra la opcion de desactivar, de lo contrario se muestra para activar
                if ($contract_type->status == "activo") {
                    return '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="' . $contract_type->id . '" data-toggle ="modal" data-target="#md_edit_contract" id="bt_contract_edit"> <i class="fas fa-solid fa-pen"></i> </a>'
                        . "&nbsp" . '<a id="contract_delete" href="javascript:void(0)" class="btn btn-sm btn-danger" data-id="' . $contract_type->id . '"><i class="fas fa-solid fa-trash"></i></a>';
                }

                else {
                    return '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="' . $contract_type->id . '" data-toggle ="modal" data-target="#md_edit_contract" id="bt_contract_edit"> <i class="fas fa-solid fa-pen"></i> </a>'
                        . "&nbsp" . '<a id="contract_activate" href="javascript:void(0)" class="btn btn-sm btn-success" data-id="' . $contract_type->id . '"><i class="fas fa-solid fa-check"></i></a>';
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
    public function store(ContractTypeCreateRequest $request)
    {
        ContractType::create([
            "name" => strtoupper($request->name)
        ]);

        $request = null;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contract_type = ContractType::findOrFail($id);

        $contract_type->update([
            "status" => "activo"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contract_type = ContractType::findOrFail($id);

        if($contract_type){
            return $contract_type;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContractTypeUpdateRequest $request, $id)
    {
        $contract_type = ContractType::findOrFail($id);

        if($contract_type){
            $contract_type->update([
                "name" => $request->name
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

          $contract_type = ContractType::findOrFail($id);

            $contract_type->update([
                "status" => "inactivo"
            ]);

    }
}
