<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::authenticateUsing(function (Request $request) {
            $request->validate([
                'n_document' => 'required|string', // Agrega las reglas necesarias
                'password' => 'required|string',
            ], [
                'n_document.required' => 'El campo N° de documento es obligatorio.',
                'password' => 'La contraseña es obligatoria.',
                // Agrega más mensajes según tus necesidades
            ]);

            $user = User::where('n_document', $request->n_document)->first();

            if (!$user || !Hash::check($request->password, $user->password) || $user->status !== "activo") {
                // Agrega un mensaje de error a la sesión
                session()->flash('error', 'Error en la autenticación (usuario y/o contraseña incorreca)
                o el usuario se encuentra inactivo.');

                // Retorna null para indicar que la autenticación no fue exitosa
                return null;
            }

            // La autenticación fue exitosa, devuelve el usuario
            return $user;
        });
    }

}
