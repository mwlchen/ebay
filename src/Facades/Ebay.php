<?php

namespace MWL\Ebay\Facades;

use Illuminate\Support\Facades\Facade;

class Ebay extends Facade
{
	protected static function getFacadeAccessor() {
		return 'ebay';
	}
}