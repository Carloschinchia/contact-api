<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder; 

class TestContactsSeeder extends Seeder
{
    public function run(): void
    {
        $contacts = [
            'anazarely@gmail.com' => [
                ['name' => 'María López', 'phone_number' => '3001234567'],
                ['name' => 'Pedro Gómez', 'phone_number' => '3012345678'],
                ['name' => 'Laura Pérez', 'phone_number' => '3023456789'],
            ],
            'kelly@gmail.com' => [
                ['name' => 'Andrés Ruiz', 'phone_number' => '3034567890'],
                ['name' => 'Sofía Torres', 'phone_number' => '3045678901'],
                ['name' => 'Daniel Castro', 'phone_number' => '3056789012'],
            ],
            'carlosjulio@gmail.com' => [
                ['name' => 'Juan Díaz', 'phone_number' => '3067890123'],
                ['name' => 'Camila Rojas', 'phone_number' => '3078901234'],
                ['name' => 'Miguel Silva', 'phone_number' => '3089012345'],
            ],
            'carlos@gmail.com' => [
                ['name' => 'Valentina Mora', 'phone_number' => '3090123456'],
                ['name' => 'David Herrera', 'phone_number' => '3101234567'],
                ['name' => 'Natalia Vega', 'phone_number' => '3112345678'],
            ],
            'rafael@gmail.com' => [
                ['name' => 'Gabriel León', 'phone_number' => '3123456789'],
                ['name' => 'Isabella Cruz', 'phone_number' => '3134567890'],
                ['name' => 'Samuel Ortiz', 'phone_number' => '3145678901'],
            ],
        ];

        foreach ($contacts as $email => $userContacts) {
            $user = User::where('email', $email)->firstOrFail();

            foreach ($userContacts as $contact) {
                $user->contacts()->create($contact);
            }
        }
    }
}
