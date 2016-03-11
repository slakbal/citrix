<?php

namespace Slakbal\Citrix\Facade;

use Illuminate\Support\Facades\Facade;
use Slakbal\Citrix\Webinar;

class GotoWebinar extends Facade
{

    protected static function getFacadeAccessor()
    {
        return Webinar::class;
    }
}