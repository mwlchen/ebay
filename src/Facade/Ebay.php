<?php

namespace MWL\Ebay\Facade;

use Illuminate\Support\Facades\Facade;

class Ebay extends Facade
{
	protected static function getFacadeAccessor() {
		return 'ebay';
	}
}