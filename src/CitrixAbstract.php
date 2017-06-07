<?php

namespace Slakbal\Citrix;

use Slakbal\Citrix\Traits\AccessObject;
use Slakbal\Citrix\Traits\CitrixClient;

/**
 * Provides common functionality for Citrix classes
 *
 * @abstract
 */
abstract class CitrixAbstract
{
    use AccessObject, CitrixClient;


    public function __construct($authType)
    {
        $this->checkAccessObject($authType); //check if API authentication is available
    }
}