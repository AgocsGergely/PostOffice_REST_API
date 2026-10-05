<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\City::query();

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->input('search') . '%');
    }

    if ($request->filled('county')) {
        $query->whereHas('county', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->input('county') . '%');
        });
    }

    $cities = $query->get();
    return response()->json(['cities' => $cities]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'zip_code' => 'required|integer',
            'name' => 'required|string|min:2|max:255',
            'id_county' => 'required|exists:counties,id',
            'population' => 'required|integer',
        ]);

        $city = \App\Models\City::create($request->all());
        return response()->json(['city' => $city], 201);
    }

    public function show($id)
    {
        $city = \App\Models\City::find($id);
        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }
        return response()->json(['city' => $city]);
    }
    public function update(Request $request, $id)
    {
        $city = \App\Models\City::find($id);
        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }

        $request->validate([
            'zip_code' => 'sometimes|required|integer',
            'name' => 'sometimes|required|string|min:2|max:255',
            'id_county' => 'sometimes|required|exists:counties,id',
            'population' => 'sometimes|required|integer',
        ]);

        $city->update($request->all());
        return response()->json(['city' => $city]);
    }
    public function destroy($id)
    {
        $city = \App\Models\City::find($id);
        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }
        $city->delete();
        return response()->json(['message' => 'City deleted successfully']);
    }
}
