<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'name' => 'Website Redesign',
                'description' => 'Redesign company website UI.',
                'status' => 'Ongoing',
                'start_date' => '2026-01-10',
                'end_date' => '2026-02-15',
                'priority' => 'HIGH',
            ],
            [
                'name' => 'Inventory System',
                'description' => 'Develop inventory tracking system.',
                'status' => 'Pending',
                'start_date' => '2026-01-20',
                'end_date' => '2026-03-01',
                'priority' => 'MEDIUM',
            ],
            [
                'name' => 'Mobile App',
                'description' => 'Build Android mobile application.',
                'status' => 'Completed',
                'start_date' => '2025-11-01',
                'end_date' => '2026-01-01',
                'priority' => 'HIGH',
            ],
            [
                'name' => 'Payroll System',
                'description' => 'Automate payroll processing.',
                'status' => 'Ongoing',
                'start_date' => '2026-02-01',
                'end_date' => '2026-04-10',
                'priority' => 'HIGH',
            ],
            [
                'name' => 'Library Management',
                'description' => 'Library management platform.',
                'status' => 'Pending',
                'start_date' => '2026-03-05',
                'end_date' => '2026-05-20',
                'priority' => 'LOW',
            ],
            [
                'name' => 'E-commerce Site',
                'description' => 'Online shopping platform.',
                'status' => 'Completed',
                'start_date' => '2025-12-15',
                'end_date' => '2026-02-01',
                'priority' => 'HIGH',
            ],
            [
                'name' => 'Attendance Tracker',
                'description' => 'Track employee attendance.',
                'status' => 'Ongoing',
                'start_date' => '2026-02-10',
                'end_date' => '2026-03-30',
                'priority' => 'MEDIUM',
            ],
            [
                'name' => 'POS System',
                'description' => 'Point of sale software.',
                'status' => 'Pending',
                'start_date' => '2026-04-01',
                'end_date' => '2026-06-15',
                'priority' => 'HIGH',
            ],
            [
                'name' => 'HR Portal',
                'description' => 'Human resources portal.',
                'status' => 'Completed',
                'start_date' => '2025-10-01',
                'end_date' => '2025-12-20',
                'priority' => 'MEDIUM',
            ],
            [
                'name' => 'Task Manager',
                'description' => 'Internal task management tool.',
                'status' => 'Cancelled',
                'start_date' => '2026-01-05',
                'end_date' => '2026-02-25',
                'priority' => 'LOW',
            ],
            [
                'name' => 'CRM Platform',
                'description' => 'Customer relationship management.',
                'status' => 'Pending',
                'start_date' => '2026-05-01',
                'end_date' => '2026-07-01',
                'priority' => 'HIGH',
            ],
            [
                'name' => 'Analytics Dashboard',
                'description' => 'Business analytics dashboard.',
                'status' => 'Completed',
                'start_date' => '2025-09-15',
                'end_date' => '2025-11-30',
                'priority' => 'MEDIUM',
            ],
            [
                'name' => 'Chat Application',
                'description' => 'Realtime messaging app.',
                'status' => 'Ongoing',
                'start_date' => '2026-02-15',
                'end_date' => '2026-04-20',
                'priority' => 'HIGH',
            ],
            [
                'name' => 'Booking System',
                'description' => 'Hotel booking platform.',
                'status' => 'Pending',
                'start_date' => '2026-03-01',
                'end_date' => '2026-05-01',
                'priority' => 'MEDIUM',
            ],
            [
                'name' => 'AI Assistant',
                'description' => 'AI chatbot integration.',
                'status' => 'Completed',
                'start_date' => '2025-08-01',
                'end_date' => '2025-10-01',
                'priority' => 'HIGH',
            ],
            [
                'name' => 'Forum Website',
                'description' => 'Community discussion forum.',
                'status' => 'Ongoing',
                'start_date' => '2026-01-12',
                'end_date' => '2026-03-15',
                'priority' => 'LOW',
            ],
            [
                'name' => 'Learning Management',
                'description' => 'Online learning platform.',
                'status' => 'Pending',
                'start_date' => '2026-04-10',
                'end_date' => '2026-08-01',
                'priority' => 'HIGH',
            ],
            [
                'name' => 'Portfolio Website',
                'description' => 'Personal portfolio redesign.',
                'status' => 'Completed',
                'start_date' => '2025-11-10',
                'end_date' => '2025-12-01',
                'priority' => 'LOW',
            ],
            [
                'name' => 'Survey System',
                'description' => 'Online survey application.',
                'status' => 'Ongoing',
                'start_date' => '2026-03-15',
                'end_date' => '2026-04-30',
                'priority' => 'MEDIUM',
            ],
            [
                'name' => 'Cloud Migration',
                'description' => 'Migrate services to cloud.',
                'status' => 'Pending',
                'start_date' => '2026-05-20',
                'end_date' => '2026-09-01',
                'priority' => 'HIGH',
            ],
        ];

        foreach ($projects as &$project) {
            $project['user_id'] = 1;
        }

        DB::table('projects')->insert($projects);
    }
}