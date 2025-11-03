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
                'project_id'   => 'PROJ001',
                'project_name' => 'Website Redesign',
                'user_ids'     => '1,2,3',
                'description'  => 'Redesign the corporate website with new UI/UX.',
                'start_date'   => '2025-11-01',
                'due_date'     => '2025-12-15',
                'status'       => 'In progress',
            ],
            [
                'project_id'   => 'PROJ002',
                'project_name' => 'Mobile App Development',
                'user_ids'     => '2,3',
                'description'  => 'Develop a cross-platform mobile app for client management.',
                'start_date'   => '2025-10-10',
                'due_date'     => '2026-01-20',
                'status'       => 'Yet to Start',
            ],
            [
                'project_id'   => 'PROJ003',
                'project_name' => 'API Integration',
                'user_ids'     => '1,4',
                'description'  => 'Integrate payment and shipping APIs for e-commerce portal.',
                'start_date'   => '2025-09-15',
                'due_date'     => '2025-11-30',
                'status'       => 'Completed',
            ],
        ];

        foreach ($projects as $project) {
            ProjectModel::create($project);
        }
    }
}
