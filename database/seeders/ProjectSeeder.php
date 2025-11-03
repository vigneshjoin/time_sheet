<?php

namespace Database\Seeders;

use App\Models\ProjectModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'project_id'   => 'PRJ001',
                'project_name' => 'Website Redesign',
                'user_ids'     => '[1,2]',
                'description'  => 'Redesign the corporate website with new UI/UX.',
                'start_date'   => '2025-11-01',
                'due_date'     => '2025-12-15',
                'status'       => 'In Progress',
            ]
        ];

        foreach ($projects as $project) {
            ProjectModel::create($project);
        }
    }
}
