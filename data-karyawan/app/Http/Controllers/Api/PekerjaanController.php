<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    public function index()
    {
        $pekerjaans = Pekerjaan::all();
        return response()->json($pekerjaans);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pekerjaan' => 'required',
            'divisi' => 'required',
        ]);

        $pekerjaan = Pekerjaan::create($validated);
        return response()->json($pekerjaan, 201);
    }

    public function show($id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        return response()->json($pekerjaan);
    }

    public function update(Request $request, $id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);

        $validated = $request->validate([
            'pekerjaan' => 'sometimes|required',
            'divisi' => 'sometimes|required',
        ]);

        $pekerjaan->update($validated);
        return response()->json($pekerjaan);
    }

    public function destroy($id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        $pekerjaan->delete();
        return response()->json(null, 204);
    }
}