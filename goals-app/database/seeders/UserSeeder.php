<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::updateOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Abdelhay Mallouli',
                'password' => 'password',
                'role' => 'admin',
            ]
        );

        // Create Author
        User::updateOrCreate(
            ['email' => 'author@test.com'],
            [
                'name' => 'Test Author',
                'password' => 'password',
                'role' => 'author',
            ]
        );
    }
}