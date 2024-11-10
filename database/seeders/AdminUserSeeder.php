<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Create Admin User
        User::create([
            'first_name' => 'Ахат',
            'last_name' => 'Админ',
            'surname' => 'Админ',
            'whatsapp_number' => '87056055051',
            'password' => Hash::make('Admin12345'),
            'role' => 'admin'
        ]);

        // Create Client User
        User::create([
            'first_name' => 'Клиент',
            'last_name' => 'Тест',
            'surname' => 'Клиент',
            'whatsapp_number' => '87056055052',
            'password' => Hash::make('Client12345'),
            'role' => 'client'
        ]);

        // Create Cashbox User
        User::create([
            'first_name' => 'Кассир',
            'last_name' => 'Тест',
            'surname' => 'Кассир',
            'whatsapp_number' => '87056055053',
            'password' => Hash::make('Cashbox12345'),
            'role' => 'cashbox'
        ]);

        // Create Packer User
        User::create([
            'first_name' => 'Упаковщик',
            'last_name' => 'Тест',
            'surname' => 'Упаковщик',
            'whatsapp_number' => '87056055054',
            'password' => Hash::make('Packer12345'),
            'role' => 'packer'
        ]);

        // Create Storage User
        User::create([
            'first_name' => 'Склад',
            'last_name' => 'Тест',
            'surname' => 'Склад',
            'whatsapp_number' => '87056055055',
            'password' => Hash::make('Storage12345'),
            'role' => 'storage'
        ]);

        // Create Courier User
        User::create([
            'first_name' => 'Курьер',
            'last_name' => 'Тест',
            'surname' => 'Курьер',
            'whatsapp_number' => '87056055056',
            'password' => Hash::make('Courier12345'),
            'role' => 'courier'
        ]);

        $this->command->info('Admin, Client, Cashbox, Packer, Storage, and Courier users created successfully!');
    }
}
