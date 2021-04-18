<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PersistentUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Default Labs',
            'email' => 'defaultacc@neurallabs.africa',
            'email_verified_at' => now(),
            'role_id' => 1,
            'telephone' => '0111111111',
            'password' => Hash::make('Neurall@b$2021'),
            'remember_token' => Str::random(10),
            'updated_at' => Carbon::now()
        ]);
    }
}
