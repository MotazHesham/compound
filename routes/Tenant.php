<?php
Route::group(['prefix' => LaravelLocalization::setLocale(),

    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::post('/Tenant/login', 'AuthController@login')->name('Tenant.login');

    Route::prefix('Tenant')->group(function () {
        Route::get('/login', function () {
            return view('Tenant.login');
        });
        Route::middleware('auth:Tenant')->group(function () {

            Route::get('/logout/logout', 'AuthController@logout')->name('Tenant.logout');
            Route::get('/home', 'AuthController@index')->name('Tenant.dashboard');

            // Profile Route
            Route::prefix('profile')->group(function () {
                Route::get('/index', 'profileController@index')->name('profile.index');
                Route::post('/index', 'profileController@update')->name('profile.update');
            });

            /** Monitors */
            Route::prefix('Monitors')->group(function () {
                Route::get('/index', 'MonitorsController@index')->name('MonitorsTenant.index');
                Route::get('/allData', 'MonitorsController@allData')->name('MonitorsTenant.allData');
                Route::post('/create', 'MonitorsController@create')->name('MonitorsTenant.create');
                Route::get('/edit/{id}', 'MonitorsController@edit')->name('MonitorsTenant.edit');
                Route::post('/update', 'MonitorsController@update')->name('MonitorsTenant.update');
                Route::get('/destroy/{id}', 'MonitorsController@destroy')->name('MonitorsTenant.destroy');
            });

            /** Order */
            Route::prefix('OrderTenant')->group(function () {
                Route::get('/index', 'OrdersController@index')->name('OrderTenant.index');
                Route::get('/allData', 'OrdersController@allData')->name('OrderTenant.allData');
                Route::post('/create', 'OrdersController@create')->name('OrderTenant.create');
                Route::get('/edit/{id}', 'OrdersController@edit')->name('OrderTenant.edit');
                Route::post('/update', 'OrdersController@update')->name('OrderTenant.update');
                Route::get('/destroy/{id}', 'OrdersController@destroy')->name('OrderTenant.destroy');
            });

            /** PartyT */

            Route::prefix('PartyT')->group(function () {
                Route::get('/index', 'PartyController@index')->name('PartyT.index');
                Route::get('/allData', 'PartyController@allData')->name('PartyT.allData');
                Route::get('/show/{id}', 'PartyController@show')->name('PartyT.show');
                Route::post('/bookNow', 'PartyController@bookNow')->name('PartyT.bookNow');
            });

            /** BookingParty */
            Route::prefix('BookingParty')->group(function () {
                Route::get('/index', 'BookingPartyController@index')->name('BookingParty.index');
                Route::get('/allData', 'BookingPartyController@allData')->name('BookingParty.allData');
                Route::get('/create', 'BookingPartyController@create')->name('BookingParty.create');
                Route::get('/edit/{id}', 'BookingPartyController@edit')->name('BookingParty.edit');
                Route::post('/update', 'BookingPartyController@update')->name('BookingParty.update');
                Route::get('/destroy/{id}', 'BookingPartyController@destroy')->name('BookingParty.destroy');
            });

            /** TParty2 */
            Route::prefix('TParty2')->group(function () {
                Route::get('/index', 'Party2Controller@index')->name('TParty2.index');
                Route::get('/allData', 'Party2Controller@allData')->name('TParty2.allData');
                Route::get('/create', 'Party2Controller@create')->name('TParty2.create');
                Route::get('/edit/{id}', 'Party2Controller@edit')->name('TParty2.edit');
                Route::get('/destroy/{id}', 'Party2Controller@destroy')->name('TParty2.destroy');
            });

            Route::get('/calender', 'PartyController@calender')->name('PartyT.calender');

        });
    });

});

