
<?php

use App\Models\Contact;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('un usuario puede tener varios contactos', function () {
    $user = User::factory()->create();

    Contact::factory(3)->create([
        'user_id' => $user->id,
    ]);

    expect($user->contacts)->toHaveCount(3);
});

test('un usuario autenticado puede listar sus contactos', function () {
    $user = User::factory()->create();

    Contact::factory(3)->create([
        'user_id' => $user->id,
    ]);

    Sanctum::actingAs($user);

    $response = $this->getJson('/api/v1/contacts');

    $response->assertOk()
        ->assertJsonCount(3, 'data');
});

test('un usuario autenticado puede crear un contacto', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->postJson('/api/v1/contacts', [
        'name' => 'María López',
        'phone_number' => '3001234567',
    ]);

    $response->assertCreated()
        ->assertJsonPath('data.name', 'María López')
        ->assertJsonPath('data.phone_number', '3001234567');

    $this->assertDatabaseHas('contacts', [
        'user_id' => $user->id,
        'name' => 'María López',
        'phone_number' => '3001234567',
    ]);
});

test('un usuario sin autenticación no puede listar contactos', function () {
    $response = $this->getJson('/api/v1/contacts');

    $response->assertUnauthorized();
});
