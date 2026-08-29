<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'role_name' => 'Admin',
                'description' => 'Administrator role with full access',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => 'Cashier',
                'description' => 'Cashier role with access to payment and transaction features',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => 'Chef',
                'description' => 'Chef role with access to kitchen operations',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => 'Customer',
                'description' => 'Regular user role with limited access',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}