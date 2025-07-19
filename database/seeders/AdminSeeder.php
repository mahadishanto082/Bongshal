<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Mr Admin',
            'email' => 'admin@bookshop.com',
            'mobile' => '01700000000',
            'email_verified_at' => now(),
            'password' => bcrypt(12345678),
            'status' => 'Active',
        ]);
    }
}
