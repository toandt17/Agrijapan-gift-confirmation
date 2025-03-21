<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@agrijapan.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create another admin user with toandt17.dev@gmail.com
        User::create([
            'name' => 'Toan DT',
            'email' => 'toandt17.dev@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create agent user
        User::create([
            'name' => 'Agent User',
            'email' => 'agent@agrijapan.com',
            'password' => Hash::make('password'),
            'role' => 'agent',
        ]);
    }
}
