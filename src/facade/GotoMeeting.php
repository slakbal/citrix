<?php

namespace Slakbal\Citrix\Facade;

use Slakbal\Citrix\Meeting;
use Illuminate\Support\Facades\Facade;

class GotoMeeting extends Facade
{

    protected static function getFacadeAccessor()
    {
        return Meeting::class;
    }
}