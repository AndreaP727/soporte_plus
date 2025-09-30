<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::create([
            'nombre' => 'Admin General',
            'correo' => 'admin@soporteplus.com',
            'contrasena' => Hash::make('admin123'),
            'rol' => 'admin',
        ]);

        Usuario::create([
            'nombre' => 'Tecnico Juan',
            'correo' => 'tecnico@soporteplus.com',
            'contrasena' => Hash::make('tecnico123'),
            'rol' => 'tecnico',
        ]);

        Usuario::create([
            'nombre' => 'Cliente Pedro',
            'correo' => 'cliente@soporteplus.com',
            'contrasena' => Hash::make('cliente123'),
            'rol' => 'cliente',
        ]);
    }
}