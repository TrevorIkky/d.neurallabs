<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function  __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::latest()->get();

        return response(['data' => $users], 200);
    }

    public function get_all_users()
    {
        $data = \App\Models\User::orderBy('created_at', 'asc')->get();
        return response()->json(['data' => $data], 200);
    }

    public function get_users_with_token()
    {
        $data = \App\Models\User::where(['role_id' => 2])->get();
        $data = collect($data)->map(function ($item, $key) {
            return [
                'index' => $key + 1,
                'name' => $item->name,
                'user_id' => $item->user_id,
                'email' => $item->email,
                'telephone' => $item->telephone,
                'token_id' => $item->tokens->isEmpty() ? null :   $item->tokens->first()->id,
                'is_token_null' => $item->tokens->isEmpty(),
                'token' => !$item->tokens->isEmpty() ?  $item->tokens->first()->name : 'Missing Access Token'
            ];
        });
        return response()->json(['data' => $data], 200);
    }

    public function change_suspension(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));
        $user->update(['suspended' => $request->input('status')]);
        return response()->json(['msg' => "User modified successfully!"], 200);
    }


    public function revoke_access_token(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'token_id' => 'required',
            'user_id' => 'required'
        ]);

        if ($Validator->fails()) {
            return response()->json(['msg' => "Missing details!"], 422);
        }
        User::find($request->input('user_id'))->tokens()->where('id', $request->input('token_id'))->delete();

        return response()->json(['msg' => "Token revoked!"], 200);
    }

    public function regenerate_access_token(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);

        if ($Validator->fails()) {
            return response()->json(['msg' => "Missing details!"], 422);
        }
        $random_name = Str::random(10);
        $token = User::find($request->input('user_id'))->createToken($random_name)->plainTextToken;

        return response()->json(['msg' => "Token generated successfully!", 'token_name' => $random_name, 'token' => $token], 200);
    }



    public function bar_graph_by_month()
    {

        $total_users = User::count();
        $data = User::selectRaw('*, DAY(updated_at) as la_day, MONTH(updated_at) as la_month')->orderBy('updated_at', 'desc')->take(7)->get()->groupBy('la_day');
        $data = collect($data)->map(function ($item, $key) use ($total_users) {
            return [
                'active' => $item->count(),
                'inactive' => $total_users - $item->count()
            ];
        });
        return response()->json(['data' => $data], 200);
    }



    public function store(UserRequest $request)
    {
        $user = User::create($request->all());

        return response(['data' => $user], 201);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return response(['data', $user], 200);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response(['data' => $user], 200);
    }

    public function destroy($id)
    {
        User::destroy($id);

        return response(['data' => null], 204);
    }
}
