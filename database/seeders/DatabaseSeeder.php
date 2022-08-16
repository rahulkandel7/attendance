<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::create([
                'name' => 'rahul',
                'email' => 'r@g.com',
                'password' => bcrypt('password'),
                'address' => 'Gaindakot',
                'phone' => '9815209300',
                'position' => 'Developer',
                'role' => 'user',
                'entry_time'=> '05:00',
                'exit_time'=> '22:00',
                'dob' => '1998-01-01'
            ]);

    }
}
