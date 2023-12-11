<?php


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

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'tenant','as' => 'api.', 'namespace' => 'Api\Tenant', 'middleware' => 'changelanguage'], function () { 

    Route::post('login','UserAuthApiController@login'); 
    Route::post('login_via_phone','UserAuthApiController@login_via_phone');  
    

    Route::group(['middleware' => ['auth:sanctum']],function () {

        // delete the token
        Route::delete('logout','UserAuthApiController@logout');  

        Route::post('fcm-token','UsersApiController@update_fcm_token'); 

        //home
        Route::get('sliders','HomeApiController@sliders'); 
        Route::get('home/services','HomeApiController@services'); 
        Route::get('home/requests','HomeApiController@requests'); 

        //services
        Route::get('services','ServiceApiController@services'); 

        //requests
        Route::group(['prefix' =>'requests'],function(){
            Route::get('upcoming','RequestsApiController@upcoming');
            Route::get('completed','RequestsApiController@completed');
            Route::get('closed','RequestsApiController@closed');
            Route::post('rate','RequestsApiController@rate'); 
            Route::post('add','RequestsApiController@add'); 
            Route::post('available_times','RequestsApiController@available_times'); 
            Route::post('add_invoice','RequestsApiController@add_invoice'); 
            Route::delete('delete/{id}','RequestsApiController@delete');
        });

        
        Route::post('rate_technical','RequestsApiController@rate_technical'); 

        //user profile
        Route::group(['prefix' =>'profile'],function(){
            Route::get('/','UsersApiController@profile'); 
        });
    });
});
