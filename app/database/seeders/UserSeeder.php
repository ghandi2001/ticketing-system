<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'sa',
            'surname' => 'admin',
            'phone_number' => '09121111111',
            'personnel_code' => '11111111',
            'profile_picture' => 'images/avatar/man.png',
            'has_accessed' => 1,
            'phone_number_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10)
        ])->assignRole('superAdmin');

    }
}
