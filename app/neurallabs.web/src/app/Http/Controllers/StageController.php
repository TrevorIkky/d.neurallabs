<?php

namespace App\Http\Controllers;

use App\Http\Requests\StageRequest;
use App\Stage;

class StageController extends Controller
{
    public function index()
    {
        $stages = Stage::latest()->get();

        return response(['data' => $stages ], 200);
    }

    public function store(StageRequest $request)
    {
        $stage = Stage::create($request->all());

        return response(['data' => $stage ], 201);

    }

    public function show($id)
    {
        $stage = Stage::findOrFail($id);

        return response(['data', $stage ], 200);
    }

    public function update(StageRequest $request, $id)
    {
        $stage = Stage::findOrFail($id);
        $stage->update($request->all());

        return response(['data' => $stage ], 200);
    }

    public function destroy($id)
    {
        Stage::destroy($id);

        return response(['data' => null ], 204);
    }
}
