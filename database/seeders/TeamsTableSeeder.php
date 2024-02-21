<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            [
                'id'             => 1,
                'name'           => 'Simple Team',
                'owner_id'          => 1,
            ],
            [
                'id'             => 2,
                'name'           => 'Marketing',
                'owner_id'       => 1,
            ],
            [
                'id'             => 3,
                'name'           => 'IT',
                'owner_id'       => 1,
            ],
            [
                'id'             => 4,
                'name'           => 'Finance',
                'owner_id'       => 1,
            ],
        ];
        Team::insert($teams);
    }
}
