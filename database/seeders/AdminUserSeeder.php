<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);
    }
}