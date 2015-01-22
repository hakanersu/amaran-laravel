<?php
namespace Xuma\Amaran\Facades;

use Illuminate\Support\Facades\Facade;

class Amaran extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'amaran';
	}
}
