<?php
Route::group(['prefix' => LaravelLocalization::setLocale(),

    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::post('/admin/login', 'AuthController@login')->name('admin.login');

    Route::prefix('Admin')->group(function () {
        Route::get('/login', function () {
            return view('Admin.loginAdmin');
        });
        Route::group(['middleware' => 'roles', 'roles' => ['Admin']], function () {

            Route::get('/logout/logout', 'AuthController@logout')->name('user.logout');
            Route::get('/home', 'AuthController@index')->name('admin.dashboard');

            // Profile Route
            Route::prefix('profile')->group(function () {
                Route::get('/index', 'profileController@index')->name('profile.index');
                Route::post('/index', 'profileController@update')->name('profile.update');
            });

            // Admin Routes
            Route::prefix('Admin')->group(function () {
                Route::get('/index', 'AdminController@index')->name('Admin.index');
                Route::get('/allData', 'AdminController@allData')->name('Admin.allData');
                Route::post('/create', 'AdminController@create')->name('Admin.create');
                Route::get('/edit/{id}', 'AdminController@edit')->name('Admin.edit');
                Route::post('/update', 'AdminController@update')->name('Admin.update');
                Route::get('/destroy/{id}', 'AdminController@destroy')->name('Admin.destroy');
            });

            /** Compound */
            Route::prefix('Compound')->group(function () {
                Route::get('/index', 'CompoundController@index')->name('Compound.index');
                Route::get('/allData', 'CompoundController@allData')->name('Compound.allData');
                Route::post('/create', 'CompoundController@create')->name('Compound.create');
                Route::get('/edit/{id}', 'CompoundController@edit')->name('Compound.edit');
                Route::post('/update', 'CompoundController@update')->name('Compound.update');
                Route::get('/destroy/{id}', 'CompoundController@destroy')->name('Compound.destroy');
            });

            /** PartyType */
            Route::prefix('PartyType')->group(function () {
                Route::get('/index', 'PartyTypeController@index')->name('PartyType.index');
                Route::get('/allData', 'PartyTypeController@allData')->name('PartyType.allData');
                Route::post('/create', 'PartyTypeController@create')->name('PartyType.create');
                Route::get('/edit/{id}', 'PartyTypeController@edit')->name('PartyType.edit');
                Route::post('/update', 'PartyTypeController@update')->name('PartyType.update');
                Route::get('/destroy/{id}', 'PartyTypeController@destroy')->name('PartyType.destroy');
            });

            /** Status */
            Route::prefix('Status')->group(function () {
                Route::get('/index', 'StatusController@index')->name('Status.index');
                Route::get('/allData', 'StatusController@allData')->name('Status.allData');
                Route::post('/create', 'StatusController@create')->name('Status.create');
                Route::get('/edit/{id}', 'StatusController@edit')->name('Status.edit');
                Route::post('/update', 'StatusController@update')->name('Status.update');
                Route::get('/destroy/{id}', 'StatusController@destroy')->name('Status.destroy');
            });
            /** Tenant */
            Route::prefix('Tenant')->group(function () {
                Route::get('/index', 'TenantController@index')->name('Tenant.index');
                Route::get('/allData', 'TenantController@allData')->name('Tenant.allData');
                Route::post('/create', 'TenantController@create')->name('Tenant.create');
                Route::get('/edit/{id}', 'TenantController@edit')->name('Tenant.edit');
                Route::post('/update', 'TenantController@update')->name('Tenant.update');
                Route::get('/destroy/{id}', 'TenantController@destroy')->name('Tenant.destroy');
                Route::get('/show/{id}', 'TenantController@show')->name('Tenant.show');
                Route::post('/sendEmails', 'TenantController@sendEmails')->name('Tenant.sendEmails');
            });

            /** Monitors */
            Route::prefix('Monitors')->group(function () {
                Route::get('/index', 'MonitorsController@index')->name('Monitors.index');
                Route::get('/allData', 'MonitorsController@allData')->name('Monitors.allData');
                Route::post('/create', 'MonitorsController@create')->name('Monitors.create');
                Route::get('/edit/{id}', 'MonitorsController@edit')->name('Monitors.edit');
                Route::post('/update', 'MonitorsController@update')->name('Monitors.update');
                Route::get('/destroy/{id}', 'MonitorsController@destroy')->name('Monitors.destroy');
            });
            /** Villas */
            Route::prefix('Villas')->group(function () {
                Route::get('/index', 'VillasController@index')->name('Villas.index');
                Route::get('/allData', 'VillasController@allData')->name('Villas.allData');
                Route::post('/create', 'VillasController@create')->name('Villas.create');
                Route::get('/edit/{id}', 'VillasController@edit')->name('Villas.edit');
                Route::post('/update', 'VillasController@update')->name('Villas.update');
                Route::get('/destroy/{id}', 'VillasController@destroy')->name('Villas.destroy');
            });

            /** Category */
            Route::prefix('Category')->group(function () {
                Route::get('/index', 'CategoryController@index')->name('Category.index');
                Route::get('/allData', 'CategoryController@allData')->name('Category.allData');
                Route::post('/create', 'CategoryController@create')->name('Category.create');
                Route::get('/edit/{id}', 'CategoryController@edit')->name('Category.edit');
                Route::post('/update', 'CategoryController@update')->name('Category.update');
                Route::get('/destroy/{id}', 'CategoryController@destroy')->name('Category.destroy');
            });

            /** Piece */
            Route::prefix('Piece')->group(function () {
                Route::get('/index', 'PieceController@index')->name('Piece.index');
                Route::get('/allData', 'PieceController@allData')->name('Piece.allData');
                Route::post('/create', 'PieceController@create')->name('Piece.create');
                Route::get('/edit/{id}', 'PieceController@edit')->name('Piece.edit');
                Route::post('/update', 'PieceController@update')->name('Piece.update');
                Route::get('/destroy/{id}', 'PieceController@destroy')->name('Piece.destroy');
                Route::get('/show/{id}', 'PieceController@show')->name('Piece.show');
            });

            /** Sliders */
            Route::prefix('Slider')->group(function () {
                Route::get('/index', 'SliderController@index')->name('Slider.index');
                Route::get('/allData', 'SliderController@allData')->name('Slider.allData');
                Route::post('/create', 'SliderController@create')->name('Slider.create');
                Route::get('/edit/{id}', 'SliderController@edit')->name('Slider.edit');
                Route::post('/update', 'SliderController@update')->name('Slider.update');
                Route::get('/destroy/{id}', 'SliderController@destroy')->name('Slider.destroy');
                Route::get('/show/{id}', 'SliderController@show')->name('Slider.show');
            });

            /** exchangeOrder */
            Route::prefix('exchangeOrder')->group(function () {
                Route::get('/index', 'exchangeOrderController@index')->name('exchangeOrder.index');
                Route::get('/allData', 'exchangeOrderController@allData')->name('exchangeOrder.allData');
                Route::post('/create', 'exchangeOrderController@create')->name('exchangeOrder.create');
                Route::get('/edit/{id}', 'exchangeOrderController@edit')->name('exchangeOrder.edit');
                Route::post('/update', 'exchangeOrderController@update')->name('exchangeOrder.update');
                Route::get('/destroy/{id}', 'exchangeOrderController@destroy')->name('exchangeOrder.destroy');
                Route::get('/ChangeStatus/{id}', 'exchangeOrderController@ChangeStatus')->name('exchangeOrder.ChangeStatus');
            });

            /** Invoice */
            Route::prefix('Invoice')->group(function () {
                Route::get('/index', 'InvoiceController@index')->name('Invoice.index');
                Route::get('/allData', 'InvoiceController@allData')->name('Invoice.allData');
                Route::post('/create', 'InvoiceController@create')->name('Invoice.create');
                Route::get('/edit/{id}', 'InvoiceController@edit')->name('Invoice.edit');
                Route::post('/update', 'InvoiceController@update')->name('Invoice.update');
                Route::get('/destroy/{id}', 'InvoiceController@destroy')->name('Invoice.destroy');
            });

            /** DestroyOrder */
            Route::prefix('DestroyOrder')->group(function () {
                Route::get('/index', 'DestroyOrderController@index')->name('DestroyOrder.index');
                Route::get('/allData', 'DestroyOrderController@allData')->name('DestroyOrder.allData');
                Route::post('/create', 'DestroyOrderController@create')->name('DestroyOrder.create');
                Route::get('/edit/{id}', 'DestroyOrderController@edit')->name('DestroyOrder.edit');
                Route::post('/update', 'DestroyOrderController@update')->name('DestroyOrder.update');
                Route::get('/destroy/{id}', 'DestroyOrderController@destroy')->name('DestroyOrder.destroy');
            });

            /** order Routes */
            Route::prefix('Order')->group(function () {
                Route::get('/index', 'OrderController@index')->name('Order.index');
                Route::get('/allData', 'OrderController@allData')->name('Order.allData');
                Route::post('/create', 'OrderController@create')->name('Order.create');
                Route::get('/edit/{id}', 'OrderController@edit')->name('Order.edit');
                Route::post('/update', 'OrderController@update')->name('Order.update');
                Route::post('/assign', 'OrderController@assign')->name('Order.assign');
                Route::post('/save_piece', 'OrderController@save_piece')->name('Order.save_piece');
                Route::get('/destroy/{id}', 'OrderController@destroy')->name('Order.destroy');
                Route::get('/confirm/invoice/{id}/{status}', 'OrderController@confirm_invoice')->name('Order.confirm_invoice');
                Route::get('/show/{id}', 'OrderController@show')->name('Order.show');
                Route::get('/ChangeStatus/{id}', 'OrderController@ChangeStatus')->name('Order.ChangeStatus');
            });

            /** Party Routes */
            Route::prefix('Party')->group(function () {
                Route::get('/index', 'PartyController@index')->name('Party.index');
                Route::get('/allData', 'PartyController@allData')->name('Party.allData');
                Route::post('/create', 'PartyController@create')->name('Party.create');
                Route::get('/edit/{id}', 'PartyController@edit')->name('Party.edit');
                Route::post('/update', 'PartyController@update')->name('Party.update');
                Route::get('/destroy/{id}', 'PartyController@destroy')->name('Party.destroy');
                Route::get('/show/{id}', 'PartyController@show')->name('Party.show');
            });

            /** Bus */
            Route::prefix('Bus')->group(function () {
                Route::get('/index', 'BusController@index')->name('Bus.index');
                Route::get('/allData', 'BusController@allData')->name('Bus.allData');
                Route::post('/create', 'BusController@create')->name('Bus.create');
                Route::get('/edit/{id}', 'BusController@edit')->name('Bus.edit');
                Route::post('/update', 'BusController@update')->name('Bus.update');
                Route::get('/destroy/{id}', 'BusController@destroy')->name('Bus.destroy');
            });

            /** Bus */
            Route::prefix('Party2')->group(function () {
                Route::get('/index', 'Party2Controller@index')->name('Party2.index');
                Route::get('/allData', 'Party2Controller@allData')->name('Party2.allData');
                Route::post('/create', 'Party2Controller@create')->name('Party2.create');
                Route::get('/edit/{id}', 'Party2Controller@edit')->name('Party2.edit');
                Route::post('/update', 'Party2Controller@update')->name('Party2.update');
                Route::get('/destroy/{id}', 'Party2Controller@destroy')->name('Party2.destroy');
            });
        });
    });

});

