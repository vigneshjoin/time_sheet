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
                'staff_id'       => 'HCL2025001',
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
                'hourly_charges' => 50.00,
                'status'         => 'active',
                'email'          => 'admin@gmail.com',
                'password'       => bcrypt('admin@123'),
                'user_type'      => 'admin',
                'created_at'     => $now,
                'updated_at'     => $now
            ],
            [
                'name'           => 'Staff',
                'company_name'   => 'staff',
                'staff_id'       => 'TEST2025002',
                'hourly_charges' => 10.00,
                'status'         => 'active',
                'email'          => 'staff@gmail.com',
                'password'       => bcrypt('admin@123'),
                'user_type'      => 'staff',
                'created_at'     => $now,
                'updated_at'     => $now
            ]
        ];

        User::insert($users);

        echo "User data inserted successfully ... \n";
    }
}
