<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

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

        $areas = Area::select("id", "name", "siglas", "created_at", "updated_at")->get();

        return DataTables::of($areas)

            ->addColumn('action', function ($area) {
                return '<a href="javascript:void(0)" class="btn btn-sm btn-warning editButton" data-id="' . $area->id . '" data-toggle ="modal" data-target="#modal_categories_edit" id="area_edit"> <i class="fas fa-solid fa-pen"></i> </a>'
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
    public function store(Request $request)
    {
        //
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
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        //
    }
}
