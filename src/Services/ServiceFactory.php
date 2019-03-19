<?php

namespace MWL\Ebay\Services;

use Illuminate\Contracts\Foundation\Application;
use MWL\Ebay\Services\Service;

class ServiceFactory 
{
    public function make( Application $app, string $name = null ) : Service
    {
        if ( !isset( $app['config']['ebay'] ) ) {
            throw new \Exception( "Can not find config", 1 );
        }
        $config  = array_merge( $app['config']['ebay'], $app['config']['ebay'][$app['config']['ebay']['mode']] );
        return $this->createService( $name, $config );
    }

    protected function createService( string $name, array $config ) : Service
    {
        switch ( $name) {
            case 'shopping':
                return new ShoppingService($config);
        }
        throw new \Exception("Can not find service", 1);
    }
}