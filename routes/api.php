<?php

use App\Http\Controllers\Api\ModuleController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


#--------------------------------------------------------------------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------------------------
#Dynamic Module Api Start
Route::group(['prefix' => 'm'], function () {

    #API to Retrieve Field Names and Types
    Route::get('/validation_info/{slug}', [ModuleController::class, 'validation_info']);
    #API to Fetch Data from Relational Tables
    Route::get('/relational_data/{slug}/{field_name}', [ModuleController::class, 'relational_data'])->name('module_api.realtional_data');
    Route::get('/fetch_data/{slug}/{field_name}', [ModuleController::class, 'fetch_data'])->name('module_api.fetch_data');

    #Dynmaic Module Data Get Api (Single Or Multiple)
    Route::get('/{slug}/{id?}', [ModuleController::class, 'read']);

    #Dynamic Store Api(Insert Or Update)
    Route::post('/store/{slug}/{id?}', [ModuleController::class, 'store']);
    #Record Delete Api
    Route::delete('/destroy/{slug}/{id}', [ModuleController::class, 'delete']);

});
#Dynamic Module Api end
#--------------------------------------------------------------------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------------------------

