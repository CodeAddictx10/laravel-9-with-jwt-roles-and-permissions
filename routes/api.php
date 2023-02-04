<?php

use App\Http\Controllers\API\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::get('', fn () => response()->json('Welcome', 200));

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->get('/hi', fn () => response()->json(config('auth.name')));
Route::middleware('auth:api')->get('/hi', fn () => response()->json(config('auth.name')));

Route::group(['middleware' => ['auth:api','role:super-admin']], function () {
    Route::get('/', fn () => response()->json('Welcome', 200));
});
