<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
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
        $adminRole = Role::where('name','Admin')->first();
        // Create admin
        User::updateOrCreate([
            'role_id' => $adminRole->id,
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
        ]);

        // Create user
        $userRole = Role::where('name','User')->first();
        User::updateOrCreate([
            'role_id' => $userRole->id,
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => Hash::make('password'),
        ]);

    }
}