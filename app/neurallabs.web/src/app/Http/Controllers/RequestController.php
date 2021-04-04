<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use GuzzleHttp\Client;
use App\Mail\ApiAccess;
use App\Models\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RequestRequest;
use Illuminate\Support\Facades\Storage;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request as HttpRequest;

class RequestController extends Controller
{

    public function  __construct()
    {
        $this->middleware('auth')->except(['ml_analyze_image']);
    }


    public function index()
    {

        $requests = Request::latest()->get();

        return response(['data' => $requests], 200);
    }

    public function line_chart_by_month()
    {
        $data = [];
        if (User::find(Auth::id())->isAdministrator()) {
            $data = \App\Models\Request::selectRaw('*, MONTH(created_at) as created_month')->get()->groupBy('created_month')->map->count()->sortKeys();
        } else {
            $data = \App\Models\Request::selectRaw('*, MONTH(created_at) as created_month')->where(['user_id' => Auth::id()])->get()->groupBy('created_month')->map->count()->sortKeys();
        }

        return response()->json(['data' => $data], 200);
    }

    public function get_all_request_details()
    {
        $data = [];
        if (User::find(Auth::id())->isAdministrator()) {
            $data =  Request::with(['user', 'file', 'stages'])->orderBy('requests.created_at', 'desc')->get()->toArray();
        } else {
            $data =  \App\Models\Request::where('user_id', '=', Auth::id())->with(['user', 'file', 'stages'])->orderBy('requests.created_at', 'desc')->get()->toArray();
        }

        return response()->json(['data' => $data], 200);
    }

    public function get_request_details()
    {
        $data =  \App\Models\Request::where('user_id', '=', Auth::id())->with(['user', 'file', 'stages'])->orderBy('requests.created_at', 'desc')->get()->toArray();
        return response()->json(['data' => $data], 200);
    }

    public function display_api_token()
    {
        return view('layouts.display_api_token');
    }

    public function ml_analyze_image(HttpRequest $request)
    {

        $request->validate(['image' => 'required']);

        $image = null;
        $path = null;
        $ml_request = null;


        try {

            DB::beginTransaction();
            $image_64 = $request->input('image');
            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
            $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
            $image = str_replace($replace, '', $image_64);
            $image = str_replace(' ', '+', $image);
            $image_name = Str::random(10) . '.' . $extension;
            $path = Storage::disk('public')->put($image_name, base64_decode($image));
            $file = File::create(['path' => $path]);
            DB::commit();
            $ml_request = Request::create(['file_id' => $file->file_id, 'user_id' => $request->user()->user_id]);
        } catch (\Throwable $th) {
            Storage::delete($path);
            DB::rollBack();
        }

        $client = new Client(['base_uri' => env('ML_SERVER_URL'), 'timeout' => 5.0]);
        $client_promise = $client->postAsync('/ml_endpoint', ["image" => $image]);

        $client_promise->then(
            function (ResponseInterface $response) {
                $body_stream  = $response->getBody();
                $body = json_decode((string)$body_stream);
                return response()->json(['data' => $body], $response->getStatusCode());
            },
            function (RequestException $exception) {
                return response()->json(['message' => $exception->getMessage()],  $exception->getResponse()->getStatusCode());
            }
        );
    }

    public function api_access_mail(HttpRequest $request)
    {
        Log::info($request->input('mail_to'));
        $request->validate(['mail_to' =>  'required|string|email']);
        $mail_message = 'Welcome to Neurallabs! You have been granted access to our api. This email will no longer be valid after 1 day. Please click on the button below to complete the sign-up. Your API key will automatically be created and displayed to you once after signing-up.';
        $temp_url =  URL::temporarySignedRoute('register', now()->addDays(1));
        Mail::to($request->input('mail_to'))->send(new ApiAccess(['message' => $mail_message, 'subject' => 'Request for API access', 'url' => $temp_url]));
        return response(['msg' => 'Api access mail sent successfully!'], 200);
    }

    public function store(HttpRequest $request)
    {
        $request = Request::create($request->all());

        return response(['data' => $request], 201);
    }

    public function show($id)
    {
        $request = Request::findOrFail($id);

        return response(['data', $request], 200);
    }

    public function update(HttpRequest $request, $id)
    {
        $request = Request::findOrFail($id);
        $request->update($request->all());

        return response(['data' => $request], 200);
    }

    public function destroy($id)
    {
        Request::destroy($id);

        return response(['data' => null], 204);
    }
}
