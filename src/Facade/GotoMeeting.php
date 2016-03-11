<?php

namespace Slakbal\Citrix\Facade;

use Illuminate\Support\Facades\Facade;
use Slakbal\Citrix\Meeting;

class GotoMeeting extends Facade
{

    protected static function getFacadeAccessor()
    {
        return Meeting::class;
    }
}