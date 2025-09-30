<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Llamar al seeder de Admin
        $this->call(AdminSeeder::class);
    }
}
