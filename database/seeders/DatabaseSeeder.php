<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // panggil semua calss untuk di generete seed nya
        $this->call([
            UserSeeder::class
        ]);

        // user:factory (10)->create();
    }
}
