
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

test('un usuario autenticado puede consultar un contacto propio', function () {
    $user = User::factory()->create();

    $contact = Contact::factory()->create([
        'user_id' => $user->id,
    ]);

    Sanctum::actingAs($user);

    $response = $this->getJson("/api/v1/contacts/{$contact->id}");

    $response->assertOk()
        ->assertJsonPath('data.id', $contact->id)
        ->assertJsonPath('data.name', $contact->name);
});

test('un usuario no puede consultar contactos de otro usuario', function () {
    $anazarely = User::factory()->create();
    $kelly = User::factory()->create();

    $contact = Contact::factory()->create([
        'user_id' => $anazarely->id,
    ]);

    Sanctum::actingAs($kelly);

    $response = $this->getJson("/api/v1/contacts/{$contact->id}");

    $response->assertNotFound();
});

test('un usuario autenticado puede actualizar un contacto propio', function () {
    $user = User::factory()->create();

    $contact = Contact::factory()->create([
        'user_id' => $user->id,
    ]);

    Sanctum::actingAs($user);

    $response = $this->putJson("/api/v1/contacts/{$contact->id}", [
        'name' => 'María actualizada',
        'phone_number' => '3009876543',
    ]);

    $response->assertOk()
        ->assertJsonPath('data.name', 'María actualizada')
        ->assertJsonPath('data.phone_number', '3009876543');

    $this->assertDatabaseHas('contacts', [
        'id' => $contact->id,
        'user_id' => $user->id,
        'name' => 'María actualizada',
        'phone_number' => '3009876543',
    ]);
});
test('un usuario no puede actualizar contactos de otro usuario', function () {
    $anazarely = User::factory()->create();
    $kelly = User::factory()->create();

    $contact = Contact::factory()->create([
        'user_id' => $anazarely->id,
    ]);

    Sanctum::actingAs($kelly);

    $response = $this->putJson("/api/v1/contacts/{$contact->id}", [
        'name' => 'Nombre modificado',
        'phone_number' => '3009876543',
    ]);

    $response->assertNotFound();

    $this->assertDatabaseHas('contacts', [
        'id' => $contact->id,
        'user_id' => $anazarely->id,
        'name' => $contact->name,
        'phone_number' => $contact->phone_number,
    ]);
});