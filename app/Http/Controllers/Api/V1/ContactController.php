<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = $request->user()
            ->contacts()
            ->get();

        return response()->json([
            'data' => $contacts,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
        ]);

        $contact = $request->user()
            ->contacts()
            ->create($validated);

        return response()->json([
            'message' => 'Contacto creado correctamente.',
            'data' => $contact,
        ], 201);
    }
}
