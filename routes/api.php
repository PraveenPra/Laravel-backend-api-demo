<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginSignupController;
use App\Http\Controllers\HospitalController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("signup",[LoginSignupController::class,"userSignUp"]);

Route::post("login",[LoginSignupController::class,"userLogin"]);

Route::get("user/{email}", [LoginSignupController::class,"userDetail"]);

//route for hospital operations
Route::post("addhospital",[HospitalController::class,"create"]);

Route::get("showhospital",[HospitalController::class,"show"]);

Route::put("edithospital/{id}",[HospitalController::class,"edit"]);

Route::delete("deletehospital/{id}",[HospitalController::class,"delete"]);