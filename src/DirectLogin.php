<?php

namespace Slakbal\Citrix;

use Slakbal\Citrix\Traits\CitrixClient;

class DirectLogin
{
    use CitrixClient;

    protected $path = 'oauth/access_token';


    public function authenticate()
    {
        return $this->getAuthObject('get', $this->path, $this->getParameters());
    }


    private function getParameters()
    {
        return [
            'grant_type' => "password",
            'user_id'    => config('citrix.direct.username'),
            'password'   => config('citrix.direct.password'),
            'client_id'  => config('citrix.direct.client_id'),
        ];
    }

}