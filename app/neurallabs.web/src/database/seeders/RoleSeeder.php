<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Administrator', 'ApiConsumer'];
        foreach ($roles as $key => $value) {
            Role::create(['role'=> $value]);      
        }
    }
}
