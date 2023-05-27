<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; //panggil model user

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //masukan data user admin ke database
        User::create([
        'name'=>'Administrator',
        'email'=>'administrator@admin.com',
        'role'=>'admin',
        'password'=>'admin', // isi password akan di hash dengan algortma bcrypt
        'status'=>'aktif',
        'last_login'=>now() //built in library untuk menampilkan tanggal saat ini
        ]);


        //panggil UserFactory,generete sebanyak 50 data
        User::factory()->count(50)->create();
       
    }
}
