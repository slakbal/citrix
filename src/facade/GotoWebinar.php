<?php

namespace Slakbal\Citrix\Facade;

use Illuminate\Support\Facades\Facade;

class GotoWebinar extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'g2webinar';
	}
}