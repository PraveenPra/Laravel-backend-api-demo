<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginSignupController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Corporate\CorporateController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\Admin\AdminDashboardController;

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

//authentication
Route::post("signup",[LoginSignupController::class,"userSignUp"]);

Route::post("login",[LoginSignupController::class,"userLogin"]);

Route::get("user/{email}", [LoginSignupController::class,"userDetail"]);

//--------[route for table count]----------------------

Route::get("counts", [AdminDashboardController::class,"counts"]);

//--------[route for hospital operations]----------------------
Route::post("addhospital",[HospitalController::class,"create"]);

Route::get("showhospital",[HospitalController::class,"show"]);
Route::get("showhospital/{id}",[HospitalController::class,"showid"]);

Route::put("edithospital/{id}",[HospitalController::class,"edit"]);

Route::delete("deletehospital/{id}",[HospitalController::class,"delete"]);

//--------[route for doctor operations]----------------------
Route::post("adddoctor",[DoctorController::class,"create"]);

Route::get("showdoctor",[DoctorController::class,"show"]);

Route::put("editdoctor/{id}",[DoctorController::class,"edit"]);

Route::delete("deletedoctor/{id}",[DoctorController::class,"delete"]);

//--------[route for corporate operations]----------------------
Route::post("addcorporate",[CorporateController::class,"create"]);

Route::get("showcorporate",[CorporateController::class,"show"]);

Route::put("editcorporate/{id}",[CorporateController::class,"edit"]);

Route::delete("deletecorporate/{id}",[CorporateController::class,"delete"]);

//--------[route for donor operations]----------------------
Route::post("adddonor",[DonorController::class,"create"]);

Route::get("showdonor",[DonorController::class,"show"]);

Route::put("editdonor/{id}",[DonorController::class,"edit"]);

Route::delete("deletedonor/{id}",[DonorController::class,"delete"]);

//--------[route for club operations]----------------------
Route::post("addclub",[ClubController::class,"create"]);

Route::get("showclub",[ClubController::class,"show"]);
Route::get("showclub/{id}",[ClubController::class,"showid"]);

Route::post("editclub/{id}",[ClubController::class,"edit"]);

Route::post("deleteclub/{id}",[ClubController::class,"delete"]);