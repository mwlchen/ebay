<?php

namespace MWL\Ebay;

use \Illuminate\Contracts\Foundation\Application;

class Ebay 
{
    private $app;
    private $factory;
    private $manager;

    function __construct( Application $app, $factory ) 
    {
        $this->app     = $app;
        $this->factory = $factory;
        $this->manager = new ServiceManager( $this->app, $this->factory );
    }

    public function getItemPosition($keywords, $itemId) 
    {
        return $this->manager
        ->setService('shopping')
        ->getPosition($keywords, $itemId);
    }
}