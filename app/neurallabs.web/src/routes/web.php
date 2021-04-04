<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
})->middleware('auth');


// Authentication Routes...
Route::get('login',  [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes...
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->middleware('signed')->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset Routes...
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset']);


Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/manage_users', [HomeController::class, 'manage_users'])->name('manage_users')->middleware('auth');
Route::get('/manage_api_tokens', [HomeController::class, 'manage_api_tokens'])->name('manage_api_tokens')->middleware('auth');

Route::group(['prefix' => 'requests'], function () {
    Route::get('/line_chart_by_month', [RequestController::class, 'line_chart_by_month']);
    Route::get('/get_all_request_details', [RequestController::class, 'get_all_request_details']);
    Route::get('/get_request_details', [RequestController::class, 'get_request_details']);
    Route::get('/display_api_token', [RequestController::class, 'display_api_token'])->name('display.api.token');
    Route::post('/api_access_mail', [RequestController::class, 'api_access_mail'])->name('api_access_mail');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/bar_graph_by_month', [UserController::class, 'bar_graph_by_month']);
    Route::get('/get_all_users', [UserController::class, 'get_all_users']);
    Route::get('/get_users_with_token', [UserController::class, 'get_users_with_token']);
    Route::patch('/change_suspension', [UserController::class, 'change_suspension'])->name('change_suspension');
    Route::post('/revoke_access_token', [UserController::class, 'revoke_access_token'])->name('revoke.access.token');
    Route::post('/regenerate_access_token', [UserController::class, 'regenerate_access_token'])->name('regen.access.token');
});
