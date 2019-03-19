<?php

namespace MWL\Ebay;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use MWL\Ebay\Services\ServiceFactory;

class EbayServiceProvider extends ServiceProvider 
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/ebay.php' => config_path('ebay.php'),
        ], 'config');
    }

    public function register() 
    {
        $this->app->singleton( 'ebay', function ( Application $app ) {
                return new Ebay( $app, new ServiceFactory() );
        } );
    }
}