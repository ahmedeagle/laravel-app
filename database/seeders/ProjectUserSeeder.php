<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectUserSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        $project = Project::first();

        if ($user && $project) {
            $user->projects()->attach($project->id);
        }

    }
}
