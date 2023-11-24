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


Route::group(['prefix' => 'technical','as' => 'api.', 'namespace' => 'Api\Technical', 'middleware' => 'changelanguage'], function () { 

    Route::post('login','UserAuthApiController@login'); 
    Route::post('login_via_phone','UserAuthApiController@login_via_phone');  
    

    Route::group(['middleware' => ['auth:sanctum']],function () {

        // delete the token
        Route::delete('logout','UserAuthApiController@logout');  

        Route::post('fcm-token','UsersApiController@update_fcm_token'); 

        //requests
        Route::group(['prefix' =>'requests'],function(){
            Route::get('/','RequestsApiController@requests'); 
            Route::post('status','RequestsApiController@status'); 
            Route::post('add_invoice','RequestsApiController@add_invoice'); 
            Route::get('pieces','RequestsApiController@pieces'); 
            Route::get('closed','RequestsApiController@closed'); 
        });
        
        Route::post('add_part','RequestsApiController@add_part'); 

        //user profile
        Route::group(['prefix' =>'profile'],function(){
            Route::get('/','UsersApiController@profile'); 
        });
    });
});
