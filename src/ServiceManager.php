<?php

namespace MWL\Ebay;

use Illuminate\Contracts\Foundation\Application;
use MWL\Ebay\Services\ServiceFactory;

class ServiceManager 
{
    protected $app;
    protected $factory;
    protected $_service;
    protected $services = [];

    public function __construct( Application $app, ServiceFactory $factory ) 
    {
        $this->app     = $app;
        $this->factory = $factory;
    }

    public function service( $name ) 
    {
        if ( !isset( $this->services[$name] ) ) {
            $this->services[$name] = $this->make( $name );
        }
        return $this->services[$name];
    }

    public function setService( $name ) 
    {
        $this->_service = $this->service( $name );
        return $this;
    }

    protected function make( $name ) 
    {
        return $this->factory->make($this->app, $name);
    }

    public function purge($name) 
    {
        unset($this->services[$name]);
    }

    public function __call($method, $parameters)
    {
        if ($this->_service) {
            return $this->_service->$method(...$parameters);
        }
        throw new \Exception("Can not find service", 1);
    }
}