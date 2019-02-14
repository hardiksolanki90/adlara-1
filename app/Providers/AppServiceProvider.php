<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request as AppRequest;
use Request;
use App\Classes\Context;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(AppRequest $request)
    {
        Schema::defaultStringLength(191);
        if (config('adlara.load_configuration')) {
          $this->initProcessMaintenance();
          $this->bootApplication($request);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * [bootApplication description]
     * boot services from configured value in database
     */
    private function bootApplication($request)
    {
        $path_array = $request->segments();
        if (in_array(config('adlara.admin_route'), $path_array)) {
            $paths = resource_path('admin/' . config('adlara.admin_theme') . '/templates');
            config(['view.paths' => $paths]);
            config(['adlara.app_scope' => 'admin']);
        } else {
            $paths = resource_path('front/' . config('adlara.front_theme') . '/templates');
        }
        view()->addLocation($paths);
        config(['adlara.context' => \App\Classes\Context::getContext()]);
        config(['adlara.request' => $request]);
    }

    protected function initProcessMaintenance()
    {
        $first_segment = Request::segment(1);
        $this->context = Context::getContext();
        $m = $this->context->configuration->get('DEBUG_MODE');
        config(['adlara.maintenance' => $m]);
    }
}
