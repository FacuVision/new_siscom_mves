<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaUpdateRequest;
use App\Http\Requests\AreaCreateRequest;
use App\Models\Area;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.areas.index");
    }

    public function listar_areas()
    {

        $areas = Area::select("id", "name", "siglas", "status", "created_at", "updated_at")->get();

        return DataTables::of($areas)

            ->addColumn('action', function ($area) {
                //Si el status del area es activo se muestra la opcion de desactivar, de lo contrario se muestra para activar
                if ($area->status == "activo") {
                    return '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="' . $area->id . '" data-toggle ="modal" data-target="#md_edit_area" id="bt_area_edit"> <i class="fas fa-solid fa-pen"></i> </a>'
                        . "&nbsp" . '<a id="area_delete" href="javascript:void(0)" class="btn btn-sm btn-danger" data-id="' . $area->id . '"><i class="fas fa-solid fa-trash"></i></a>';
                }

                else {
                    return '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="' . $area->id . '" data-toggle ="modal" data-target="#md_edit_area" id="bt_area_edit"> <i class="fas fa-solid fa-pen"></i> </a>'
                        . "&nbsp" . '<a id="area_activate" href="javascript:void(0)" class="btn btn-sm btn-success" data-id="' . $area->id . '"><i class="fas fa-solid fa-check"></i></a>';
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
    public function store(AreaCreateRequest $request)
    {

        Area::create([
            "name" => strtoupper($request->name),
            "siglas" => strtoupper($request->sigla)
        ]);

        $request = null;

        //return response()->json(['message' => 'Datos recibidos con éxito']);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //Se está reutilizando para reactivar un area

        $area = Area::findOrFail($id);

        if ($area) {
            $area->update([
                "status" => "activo"
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($area_id)
    {
        $area_edit = Area::select()->where("id", $area_id)->get();

        return $area_edit;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AreaUpdateRequest $request, $id)
    {

        $area = Area::FindOrFail($id);

        $area->update([
            "name" => strtoupper($request->name_edit),
            "siglas" => strtoupper($request->siglas_edit)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $area = Area::findOrFail($id);

        if ($area) {
            $area->update([
                "status" => "inactivo"
            ]);
        }

        // Este bloque de código es una estructura condicional en PHP.
        // Lo que hace es verificar si la variable $area no tiene un valor o si
        // es igual a null. Esto se hace utilizando el operador de negación !,
        // que invierte el valor booleano de la expresión. Entonces,
        // !$area evaluará a true si $area es null o si no tiene un valor asignado.

        //$area->delete();
    }
}
