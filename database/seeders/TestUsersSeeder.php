<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TestUsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Anazarely', 'email' => 'anazarely@gmail.com'],
            ['name' => 'Kelly', 'email' => 'kelly@gmail.com'],
            ['name' => 'Carlos Julio', 'email' => 'carlosjulio@gmail.com'],
            ['name' => 'Carlos', 'email' => 'carlos@gmail.com'],
            ['name' => 'Rafael', 'email' => 'rafael@gmail.com'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => '12345',
                ]
            );
        }
    }
}
