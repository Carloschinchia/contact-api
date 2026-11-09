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

    public function show(Request $request, int $id)
    {
        $contact = $request->user()
            ->contacts()
            ->findOrFail($id);

        return response()->json([
            'data' => $contact,
        ]);
    }
    
    public function update(Request $request, int $id)
    {
        $contact = $request->user()
            ->contacts()
            ->findOrFail($id);

        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'phone_number' => ['sometimes', 'required', 'string', 'max:20'],
        ]);

        $contact->update($validated);

        return response()->json([
            'message' => 'Contacto actualizado correctamente.',
            'data' => $contact,
        ]);
    }

}
