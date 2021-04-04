<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestStageMappingRequest;
use App\Models\RequestStageMapping;

class RequestStageMappingController extends Controller
{
    public function index()
    {
        $requeststagemappings = RequestStageMapping::latest()->get();

        return response(['data' => $requeststagemappings ], 200);
    }

    public function store(RequestStageMappingRequest $request)
    {
        $requeststagemapping = RequestStageMapping::create($request->all());

        return response(['data' => $requeststagemapping ], 201);

    }

    public function show($id)
    {
        $requeststagemapping = RequestStageMapping::findOrFail($id);

        return response(['data', $requeststagemapping ], 200);
    }

    public function update(RequestStageMappingRequest $request, $id)
    {
        $requeststagemapping = RequestStageMapping::findOrFail($id);
        $requeststagemapping->update($request->all());

        return response(['data' => $requeststagemapping ], 200);
    }

    public function destroy($id)
    {
        RequestStageMapping::destroy($id);

        return response(['data' => null ], 204);
    }
}
