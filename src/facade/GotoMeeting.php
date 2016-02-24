<?php

namespace Slakbal\Citrix\Facade;

use Illuminate\Support\Facades\Facade;

class GotoMeeting extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'g2meeting';
	}
}