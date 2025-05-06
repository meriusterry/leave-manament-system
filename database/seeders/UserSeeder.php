<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstName' => 'Terry', // Example values for initial user
            'surname' => 'Ntuli',
            'mobileNumber' => '0762478940',
            'department' => 'IT',
            'position' => 'Software Developer',
            'customerType' => 'Business',
            'status' => 'Active',
            'access' => 'True',
            'email' => 'admin@example.com', // Change this to the desired email
            'password' => bcrypt('Admin@123'), // Change this to the desired password
        ]);
    }
}
