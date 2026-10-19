<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * @api {get} /api/cities Get All Cities
     * @apiVersion 1.0.0
     * @apiName GetCities
     * @apiGroup Cities
     * @apiDescription Retrieve a list of cities. Optional search and county filters can be applied.
     *
     * @apiQuery {String} [search] Filter cities by name (partial match).
     * @apiQuery {String} [county] Filter cities by county name (partial match).
     *
     * @apiSuccess {Object[]} cities List of city objects.
     * @apiSuccess {Number} cities.id City ID.
     * @apiSuccess {Number} cities.zip_code City ZIP code.
     * @apiSuccess {String} cities.name City name.
     * @apiSuccess {Number} cities.id_county Associated county ID.
     * @apiSuccess {Number} cities.population City population.
     */
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
    /**
     * @api {post} /api/cities Create a New City
     * @apiVersion 1.0.0
     * @apiName PostCity
     * @apiGroup Cities
     * @apiDescription Store a newly created city record in the database.
     *
     * @apiBody {Number} zip_code Required ZIP code.
     * @apiBody {String{2..255}} name Required city name.
     * @apiBody {Number} id_county Required county ID (must exist in counties table).
     * @apiBody {Number} population Required city population.
     *
     * @apiSuccess {Object} city Created city object.
     * @apiSuccess {Number} city.id City ID.
     * @apiSuccess {Number} city.zip_code City ZIP code.
     * @apiSuccess {String} city.name City name.
     * @apiSuccess {Number} city.id_county Associated county ID.
     * @apiSuccess {Number} city.population City population.
     *
     * @apiError (422 Unprocessable Entity) ValidationError Validation errors for missing or invalid parameters.
     */
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

    /**
     * @api {get} /api/cities/:id Get City by ID
     * @apiVersion 1.0.0
     * @apiName GetCityById
     * @apiGroup Cities
     * @apiDescription Retrieve details of a specific city.
     *
     * @apiParam {Number} id City unique ID.
     *
     * @apiSuccess {Object} city City object.
     * @apiSuccess {Number} city.id City ID.
     * @apiSuccess {Number} city.zip_code City ZIP code.
     * @apiSuccess {String} city.name City name.
     * @apiSuccess {Number} city.id_county Associated county ID.
     * @apiSuccess {Number} city.population City population.
     *
     * @apiError (404 Not Found) CityNotFound The specified city ID does not exist.
     */

    public function show($id)
    {
        $city = \App\Models\City::find($id);
        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }
        return response()->json(['city' => $city]);
    }

    /**
     * @api {put} /api/cities/:id Update City
     * @apiVersion 1.0.0
     * @apiName UpdateCity
     * @apiGroup Cities
     * @apiDescription Update an existing city record.
     *
     * @apiParam {Number} id City unique ID.
     * @apiBody {Number} [zip_code] Updated ZIP code.
     * @apiBody {String{2..255}} [name] Updated city name.
     * @apiBody {Number} [id_county] Updated county ID.
     * @apiBody {Number} [population] Updated population.
     *
     * @apiSuccess {Object} city Updated city object.
     * 
     * @apiError (404 Not Found) CityNotFound The specified city ID does not exist.
     * @apiError (422 Unprocessable Entity) ValidationError Validation errors.
     */
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

    /**
     * @api {delete} /api/cities/:id Delete City
     * @apiVersion 1.0.0
     * @apiName DeleteCity
     * @apiGroup Cities
     * @apiDescription Delete a city record from the database.
     *
     * @apiParam {Number} id City unique ID.
     *
     * @apiSuccess {String} message Success message.
     * 
     * @apiError (404 Not Found) CityNotFound The specified city ID does not exist.
     */
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
