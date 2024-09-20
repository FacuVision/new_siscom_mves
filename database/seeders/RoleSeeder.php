<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; // Importa correctamente la clase Role
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = Role::create(["name" => "superadmin", "name_detail" => "Super administrador"]);
        //tiene control total y auditorias

        $admin = Role::create(["name" => "admin", "name_detail" => "Administrador de la unidad"]);
        //tiene control total y auditorias a excepcion de creacion de usuarios

        $register = Role::create(["name" => "register", "name_detail" => "Registrador"]);
        //Accesos a registro de comprobantes y visualizacion de tablas de mantenimiento

        Permission::create(["name"=>"admin.home"])->assignRole([$superadmin,$admin,$register]);

        //areas
        Permission::create(["name"=>"admin.areas.index"])->assignRole([$superadmin,$admin,$register]);
        Permission::create(["name"=>"admin.areas.create"])->assignRole([$superadmin,$admin,$register]);
        Permission::create(["name"=>"admin.areas.edit"])->assignRole([$superadmin,$admin]);
        Permission::create(["name"=>"admin.areas.activation"])->assignRole([$superadmin,$admin]);// permiso para activar/desactivar

        //contratos
        Permission::create(["name"=>"admin.contract_types.index"])->assignRole([$superadmin,$admin,$register]);
        Permission::create(["name"=>"admin.contract_types.create"])->assignRole([$superadmin,$admin,$register]);
        Permission::create(["name"=>"admin.contract_types.edit"])->assignRole([$superadmin,$admin]);
        Permission::create(["name"=>"admin.contract_types.activation"])->assignRole([$superadmin,$admin]); // permiso para activar/desactivar

        //tipos de documento
        Permission::create(["name"=>"admin.document_types.index"])->assignRole([$superadmin,$admin,$register]);
        Permission::create(["name"=>"admin.document_types.create"])->assignRole([$superadmin,$admin,$register]);
        Permission::create(["name"=>"admin.document_types.edit"])->assignRole([$superadmin,$admin]);
        Permission::create(["name"=>"admin.document_types.activation"])->assignRole([$superadmin,$admin]); // permiso para activar/desactivar

        //proveedores
        Permission::create(["name"=>"admin.providers.index"])->assignRole([$superadmin,$admin,$register]);
        Permission::create(["name"=>"admin.providers.create"])->assignRole([$superadmin,$admin,$register]);
        Permission::create(["name"=>"admin.providers.edit"])->assignRole([$superadmin,$admin]);
        Permission::create(["name"=>"admin.providers.activation"])->assignRole([$superadmin,$admin]); // permiso para activar/desactivar

        //usuarios
        Permission::create(["name"=>"admin.users.index"])->assignRole([$superadmin,$admin,$register]);
        Permission::create(["name"=>"admin.users.create"])->assignRole([$superadmin,$admin,$register]);
        Permission::create(["name"=>"admin.users.edit"])->assignRole([$superadmin,$admin]);
        Permission::create(["name"=>"admin.users.activation"])->assignRole([$superadmin,$admin]); // permiso para activar/desactivar


        //comprobantes


        //auditorias


        //credenciales


        //reportes

    }
}
