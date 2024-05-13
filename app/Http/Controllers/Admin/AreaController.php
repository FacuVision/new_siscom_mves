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

        $areas = Area::select("id", "name", "siglas", "created_at", "updated_at")->where("status", "activo")->get();

        return DataTables::of($areas)

            ->addColumn('action', function ($area) {
                return '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="' . $area->id . '" data-toggle ="modal" data-target="#md_edit_area" id="bt_area_edit"> <i class="fas fa-solid fa-pen"></i> </a>'
                    . "&nbsp" . '<a id="area_delete" href="javascript:void(0)" class="btn btn-sm btn-danger delButton" data-id="' . $area->id . '"><i class="fas fa-solid fa-trash"></i></a>';
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
    public function show(Area $area)
    {
        //
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
        $area = Area::FindOrFail($id);
        $area->update(["status"=>"inactivo"]);
       //return $area;
    }
}
