<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\County;
class CountiesController extends Controller
{

/**
     * @api {get} /api/counties Get All Counties
     * @apiVersion 1.0.0
     * @apiName GetCounties
     * @apiGroup Counties
     * @apiDescription Retrieve a list of all counties, with an optional search filter.
     *
     * @apiQuery {String} [search] Filter counties by name (partial match).
     *
     * @apiSuccess {Object[]} counties List of county objects.
     * @apiSuccess {Number} counties.id County ID.
     * @apiSuccess {String} counties.name County name.
     * @apiSuccess {String} counties.img_url County image URL.
     */
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

    /**
     * @api {post} /api/counties Create a New County
     * @apiVersion 1.0.0
     * @apiName PostCounty
     * @apiGroup Counties
     * @apiDescription Store a new county record.
     *
     * @apiBody {String{2..255}} name Required county name.
     * @apiBody {String{2..255}} img_url Required image URL.
     *
     * @apiSuccess {Object} county Created county object.
     * @apiSuccess {Number} county.id County ID.
     * @apiSuccess {String} county.name County name.
     * @apiSuccess {String} county.img_url County image URL.
     *
     * @apiError (422 Unprocessable Entity) ValidationError Validation errors.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'img_url' => 'required|string|min:2|max:255',
        ]);

        $county = County::create($request->all());
        return response()->json(['county' => $county], 201);
    }

    /**
     * @api {get} /api/counties/:id Get County by ID
     * @apiVersion 1.0.0
     * @apiName GetCountyById
     * @apiGroup Counties
     * @apiDescription Retrieve details of a single county.
     *
     * @apiParam {Number} id County unique ID.
     *
     * @apiSuccess {Object} county County object.
     * 
     * @apiError (404 Not Found) CountyNotFound County not found.
     */
    public function show($id)
    {
        $county = County::find($id);
        if (!$county) {
            return response()->json(['message' => 'County not found'], 404);
        }
        return response()->json(['county' => $county]);
    }


    /**
     * @api {put} /api/counties/:id Update County
     * @apiVersion 1.0.0
     * @apiName UpdateCounty
     * @apiGroup Counties
     * @apiDescription Update an existing county's details.
     *
     * @apiParam {Number} id County unique ID.
     * @apiBody {String{2..255}} [name] Updated county name.
     * @apiBody {String{2..255}} [img_url] Updated image URL.
     *
     * @apiSuccess {Object} county Updated county object.
     * 
     * @apiError (404 Not Found) CountyNotFound County not found.
     * @apiError (422 Unprocessable Entity) ValidationError Validation errors.
     */
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

    /**
     * @api {delete} /api/counties/:id Delete County
     * @apiVersion 1.0.0
     * @apiName DeleteCounty
     * @apiGroup Counties
     * @apiDescription Delete a county record.
     *
     * @apiParam {Number} id County unique ID.
     *
     * @apiSuccess {String} message Success message.
     * 
     * @apiError (404 Not Found) CountyNotFound County not found.
     */

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
