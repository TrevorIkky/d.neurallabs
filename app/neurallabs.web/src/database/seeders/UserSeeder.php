<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Request;
use App\Models\RequestStageMapping;
use App\Models\Stage;
use App\Models\User;
use Database\Factories\FileFactory;
use Database\Factories\RequestStageMappingFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stages = Stage::factory()->count(3);
        User::factory()
            ->has(Request::factory()->hasAttached($stages)->count(1)->for(File::factory()))
            ->count(10)->create();
    }
}
