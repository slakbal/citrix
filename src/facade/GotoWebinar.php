<?php

namespace Slakbal\Citrix\Facade;

use Slakbal\Citrix\Webinar;
use Illuminate\Support\Facades\Facade;

class GotoWebinar extends Facade
{

    protected static function getFacadeAccessor()
    {
        return Webinar::class;
    }
}