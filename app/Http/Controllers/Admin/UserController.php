<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.users.index");
    }

    public function listar_usuarios()
    {
        //$users = User::select("id", "name", "lastname","n_document","document_type","status")->get();

        //$users = User::with('roles')->get();
        //return $users;

        $users = User::select("users.id", "users.name", "users.lastname", "users.n_document", "users.document_type", "users.status", "name_detail")
            ->join('model_has_roles as mr', 'users.id', '=', 'mr.model_id')
            ->join('roles as r', 'r.id', '=', 'mr.role_id')
            ->get();


        return DataTables::of($users)

            ->addColumn('action', function ($user) {
                //Si el status del user es activo se muestra la opcion de desactivar, de lo contrario se muestra para activar
                if ($user->status == "activo") {
                    return '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="' . $user->id . '" data-toggle ="modal" data-target="#md_edit_user" id="bt_user_edit"> <i class="fas fa-solid fa-pen"></i> </a>'
                        . "&nbsp" . '<a id="user_delete" href="javascript:void(0)" class="btn btn-sm btn-danger" data-id="' . $user->id . '"><i class="fas fa-solid fa-trash"></i></a>';
                } else {
                    return '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="' . $user->id . '" data-toggle ="modal" data-target="#md_edit_user" id="bt_user_edit"> <i class="fas fa-solid fa-pen"></i> </a>'
                        . "&nbsp" . '<a id="user_activate" href="javascript:void(0)" class="btn btn-sm btn-success" data-id="' . $user->id . '"><i class="fas fa-solid fa-check"></i></a>';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function listar_roles()
    {
        $roles = Role::select("id","name", "name_detail")->get();
        return $roles;
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
    public function store(UserCreateRequest $request)
    {
        User::create([
            'name' => strtoupper($request->name),
            'email' => $request->email,
            "password" => bcrypt($request->n_document),
            'lastname' => strtoupper($request->lastname),
            'document_type' => $request->document_type,
            'n_document' => $request->n_document,
            'creation_document' => strtoupper($request->creation_document)
        ])->assignRole($request->select_roles);
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
