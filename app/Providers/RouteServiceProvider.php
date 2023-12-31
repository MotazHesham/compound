<?php


namespace App\Providers;


use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;


class RouteServiceProvider extends ServiceProvider

{

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */

    protected $namespace = 'App\Http\Controllers\Fronted';

    protected $Apinamespace = 'App\Http\Controllers';

    protected $adminNamespace = 'App\Http\Controllers\Admin';

    protected $tenantNameSpace = 'App\Http\Controllers\Tenant';


    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */

    public function boot()

    {

        //


        parent::boot();

    }


    /**
     * Define the routes for the application.
     *
     * @return void
     */

    public function map()

    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapAdminRoutes();
        $this->mapTenantRoutes();
    }


    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */

    protected function mapWebRoutes()

    {

        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));

    }


    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */

    protected function mapApiRoutes()

    {

        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->Apinamespace)
            ->group(base_path('routes/api_tenant.php'));

        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->Apinamespace)
            ->group(base_path('routes/api_technical.php'));
    }


    protected function mapAdminRoutes()
    {
        Route::middleware('web')
            ->namespace($this->adminNamespace)
            ->group(base_path('routes/Admin.php'));
    }

    /**
     *
     */
    protected function mapTenantRoutes()
    {
        Route::middleware('web')
            ->namespace($this->tenantNameSpace)
            ->group(base_path('routes/Tenant.php'));
    }

}

