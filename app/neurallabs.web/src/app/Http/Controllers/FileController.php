<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\File;

class FileController extends Controller
{
    public function index()
    {
        $files = File::latest()->get();

        return response(['data' => $files ], 200);
    }

    public function store(FileRequest $request)
    {
        $file = File::create($request->all());

        return response(['data' => $file ], 201);

    }

    public function show($id)
    {
        $file = File::findOrFail($id);

        return response(['data', $file ], 200);
    }

    public function update(FileRequest $request, $id)
    {
        $file = File::findOrFail($id);
        $file->update($request->all());

        return response(['data' => $file ], 200);
    }

    public function destroy($id)
    {
        File::destroy($id);

        return response(['data' => null ], 204);
    }
}
