<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        $users = [
            [
                'name'           => 'Vignesh BG',
                'company_name'   => 'HCL',
                'staff_id'       => 'HCL2025001', // Added unique suffix
                'hourly_charges' => 35.00,
                'status'         => 'active',
                'email'          => 'vignesh@gmail.com',
                'password'       => bcrypt('admin@123'),
                'user_type'      => 'super_admin',
                'created_at'     => $now,
                'updated_at'     => $now
            ],
            [
                'name'           => 'Admin',
                'company_name'   => 'test',
                'staff_id'       => 'TEST2025001',
                'hourly_charges' => 0.00,
                'status'         => 'active',
                'email'          => 'admin@gmail.com',
                'password'       => bcrypt('admin@123'),
                'user_type'      => 'admin',
                'created_at'     => $now,
                'updated_at'     => $now
            ],
            [
                'name' => 'John Smith',
                'company_name' => 'ABC Corp',
                'staff_id' => 'ABC2025001',
                'hourly_charges' => 25.00,
                'status' => 'active',
                'email' => 'john.smith@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Sarah Johnson',
                'company_name' => 'XYZ Ltd',
                'staff_id' => 'XYZ2025001',
                'hourly_charges' => 30.00,
                'status' => 'active',
                'email' => 'sarah.j@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Michael Brown',
                'company_name' => 'Tech Solutions',
                'staff_id' => 'TECH2025001',
                'hourly_charges' => 35.00,
                'status' => 'active',
                'email' => 'mike.b@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Emily Davis',
                'company_name' => 'Global Inc',
                'staff_id' => 'GLOBAL2025001',
                'hourly_charges' => 28.00,
                'status' => 'active',
                'email' => 'emily.d@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'David Wilson',
                'company_name' => 'Smart Tech',
                'staff_id' => 'SMART2025001',
                'hourly_charges' => 32.00,
                'status' => 'active',
                'email' => 'david.w@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Lisa Anderson',
                'company_name' => 'First Tech',
                'staff_id' => 'FIRST2025001',
                'hourly_charges' => 27.00,
                'status' => 'active',
                'email' => 'lisa.a@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'James Taylor',
                'company_name' => 'Innovatech',
                'staff_id' => 'INNO2025001',
                'hourly_charges' => 29.00,
                'status' => 'active',
                'email' => 'james.t@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Patricia Miller',
                'company_name' => 'Synergy Co',
                'staff_id' => 'SYNERGY2025001',
                'hourly_charges' => 31.00,
                'status' => 'active',
                'email' => 'patricia.m@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Robert Garcia',
                'company_name' => 'NextGen',
                'staff_id' => 'NEXTGEN2025001',
                'hourly_charges' => 33.00,
                'status' => 'active',
                'email' => 'robert.g@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Jennifer Martinez',
                'company_name' => 'Pioneers',
                'staff_id' => 'PIONEER2025001',
                'hourly_charges' => 26.00,
                'status' => 'active',
                'email' => 'jennifer.m@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'William Hernandez',
                'company_name' => 'Visionary',
                'staff_id' => 'VISION2025001',
                'hourly_charges' => 34.00,
                'status' => 'active',
                'email' => 'william.h@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Elizabeth Lopez',
                'company_name' => 'Achievers',
                'staff_id' => 'ACHIEVE2025001',
                'hourly_charges' => 36.00,
                'status' => 'active',
                'email' => 'elizabeth.l@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Charles Gonzalez',
                'company_name' => 'Strivers',
                'staff_id' => 'STRIVE2025001',
                'hourly_charges' => 37.00,
                'status' => 'active',
                'email' => 'charles.g@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Susan Perez',
                'company_name' => 'GoGetters',
                'staff_id' => 'GOGE2025001',
                'hourly_charges' => 38.00,
                'status' => 'active',
                'email' => 'susan.p@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Joseph Wilson',
                'company_name' => 'Trailblazers',
                'staff_id' => 'TRAIL2025001',
                'hourly_charges' => 39.00,
                'status' => 'active',
                'email' => 'joseph.w@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Karen Lee',
                'company_name' => 'Pathfinders',
                'staff_id' => 'PATH2025001',
                'hourly_charges' => 40.00,
                'status' => 'active',
                'email' => 'karen.lee@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Nancy Walker',
                'company_name' => 'Innovators',
                'staff_id' => 'INNO2025002',
                'hourly_charges' => 41.00,
                'status' => 'active',
                'email' => 'nancy.w@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Betty Hall',
                'company_name' => 'Creators',
                'staff_id' => 'CREATE2025001',
                'hourly_charges' => 42.00,
                'status' => 'active',
                'email' => 'betty.h@example.com',
                'password' => bcrypt('admin@123'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        User::insert($users);

        echo "User data inserted successfully ... \n";
    }
}
