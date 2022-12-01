<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       $user = User::firstOrCreate([
           'email'=>'admin@gmail.com',
           ],
         [  'password'=>Hash::make('admin'),
             'fullname'=>"Vu Van Nghia",
             'name'=>"hellAngle",
             'role'=>'1',
             'created_at' => now(),
             'updated_at' => now(),
       ]);
       User::factory(10)->create();

    }
}
