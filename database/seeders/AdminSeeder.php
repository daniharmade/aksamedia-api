<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'id' => Str::uuid(),
            'name' => 'Admin Aksamedia',
            'username' => 'admin',
            'phone' => '081234567890',
            'email' => 'admin@example.com',
            'password' => Hash::make('pastibisa'),
        ]);
    }
}
