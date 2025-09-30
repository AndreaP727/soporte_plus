<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Verificar si ya existe un admin
        if (!Usuario::where('rol', 'admin')->exists()) {
            Usuario::create([
                'nombre' => 'Administrador',
                'correo' => 'admin@soporteplus.com',
                'contrasena' => Hash::make('admin123'),
                'rol' => 'admin',
            ]);
        }
    }
}