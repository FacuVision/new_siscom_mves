<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RoleSeeder::class);

        User::factory()->create([
            'name' => 'Emmanuel',
            'status' => 'activo',
            'email' => 'admin@munives.com',
            "password" => bcrypt("74741985"),
            'lastname' => 'Garayar',
            'document_type' => 'DNI',
            'n_document' => '74741985',
            'lastname' => 'Garayar',
            'creation_document' => 'MEMORANDO N° 101-2024-UDT-OGA/MVES'
        ])->assignRole("superadmin");

    }
}
