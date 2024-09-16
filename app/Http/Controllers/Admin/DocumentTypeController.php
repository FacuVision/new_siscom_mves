<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentType;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\DocumentTypeCreateRequest;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.documents.index");
    }

    function listar_documents() {
        $document_types = DocumentType::select("id", "name", "status")->get();

        return DataTables::of($document_types)

            ->addColumn('action', function ($document_type) {
                //Si el status del document es activo se muestra la opcion de desactivar, de lo contrario se muestra para activar
                if ($document_type->status == "activo") {
                    return '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="' . $document_type->id . '" data-toggle ="modal" data-target="#md_edit_document" id="bt_document_edit"> <i class="fas fa-solid fa-pen"></i> </a>'
                        . "&nbsp" . '<a id="document_delete" href="javascript:void(0)" class="btn btn-sm btn-danger" data-id="' . $document_type->id . '"><i class="fas fa-solid fa-trash"></i></a>';
                }

                else {
                    return '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="' . $document_type->id . '" data-toggle ="modal" data-target="#md_edit_document" id="bt_document_edit"> <i class="fas fa-solid fa-pen"></i> </a>'
                        . "&nbsp" . '<a id="document_activate" href="javascript:void(0)" class="btn btn-sm btn-success" data-id="' . $document_type->id . '"><i class="fas fa-solid fa-check"></i></a>';
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
    public function store(DocumentTypeCreateRequest $request)
    {

        DocumentType::create([
            "name" => $request->name
        ]);

        $request = null;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
