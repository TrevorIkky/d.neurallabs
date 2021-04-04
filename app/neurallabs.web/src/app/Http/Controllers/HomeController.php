<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['dashboard', 'manage_users', 'manage_api_tokens']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        return view('layouts.dashboard');
    }
    public function manage_users()
    {
        return view('layouts.manage_users');
    }

    public function manage_api_tokens()
    {
        return view('layouts.manage_api_tokens');
    }
}
