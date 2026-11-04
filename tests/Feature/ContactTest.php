<?php

use App\Models\User;
use App\Models\Contact;

test('un usuario puede tener varios contactos', function () {
    $user = User::factory()->create();

    Contact::factory(3)->create([
        'user_id' => $user->id,
    ]);

    expect($user->contacts)->toHaveCount(3);
});