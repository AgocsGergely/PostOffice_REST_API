<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\County;
class CountiesController extends Controller
{
    public function index(Request $request)
    {
        $query = County::query();

    // e.g., /api/counties?search=pest
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->input('search') . '%');
    }

    $counties = $query->get();

    return response()->json(['counties' => $counties]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'img_url' => 'required|string|min:2|max:255',
        ]);

        $county = County::create($request->all());
        return response()->json(['county' => $county], 201);
    }
    public function show($id)
    {
        $county = County::find($id);
        if (!$county) {
            return response()->json(['message' => 'County not found'], 404);
        }
        return response()->json(['county' => $county]);
    }

    public function update(Request $request, $id)
    {
        $county = County::find($id);
        if (!$county) {
            return response()->json(['message' => 'County not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|min:2|max:255',
            'img_url' => 'sometimes|required|string|min:2|max:255',
        ]);

        $county->update($request->all());
        return response()->json(['county' => $county]);
    }

    public function destroy($id)
    {
        $county = County::find($id);
        if (!$county) {
            return response()->json(['message' => 'County not found'], 404);
        }
        $county->delete();
        return response()->json(['message' => 'County deleted successfully']);
    }
}
