<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

use App\Models\Permission;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate(['name' => 'Admin', 'slug' => 'admin', 'deletable' => false]);
        Role::updateOrCreate(['name' => 'User', 'slug' => 'user', 'deletable' => true]);
    }
}
