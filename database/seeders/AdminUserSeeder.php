<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'first_name' => 'Ахат',
            'last_name' => 'Админ',
            'surname' => 'Админ',
            'whatsapp_number' => '87054052651',
            'password' => Hash::make('Admin12345'),
            // Add other necessary fields like 'role' if required
            'role' => 'admin'
        ]);
    }
}
