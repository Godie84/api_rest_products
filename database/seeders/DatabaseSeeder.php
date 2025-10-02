<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        //Crear usuario de prueba

        User::factory()->create([
            'name' => 'Diego Reina',
            'email' => 'diego.reina9@hotmail.com',
            'password' => bcrypt('1234567890')
        ]);

        //Llamar al seeder de productos
        $this->call([
            ProductSeeder::class,
        ]);
    }
}
