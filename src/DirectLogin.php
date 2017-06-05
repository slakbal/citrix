<?php

namespace Slakbal\Citrix;

use Httpful\Mime;
use Httpful\Request;
use Illuminate\Support\Facades\Log;
use Slakbal\Citrix\Exception\CitrixAuthenticateException;

class DirectLogin
{

    protected $base_uri = 'https://api.getgo.com/oauth/access_token';

    protected $timeout = 5.0;

    protected $verify_ssl = false;


    public function __construct()
    {
    }


    public function authenticate()
    {
        $response = Request::get($this->getParameterizedUri())
                           ->withoutStrictSsl()// Ease up on some of the SSL checks
                           ->expectsJson()// Expect JSON responses
                           ->timeout($this->timeout)
                           ->sendsType(Mime::FORM)// Send application/x-www-form-urlencoded
                           ->send();

        //dd($response);
        $this->processResultCode($response);

        return $response;
    }


    private function getParameterizedUri()
    {
        return $this->base_uri . '?' . http_build_query($this->getParameters());
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


    /**
     * @param $response
     *
     * @throws CitrixAuthenticateException
     */
    private function processResultCode($response)
    {
        //dd($response);
        if ($response->code != 200) {

            Log::error('CITRIX: ' . $response->raw_body);

            throw new CitrixAuthenticateException($response->raw_body);
        }

        //401 Unauthorized

        //403

        //etc
        Log::info('CITRIX: Successful renewal of AuthenticationObject via - ' . $this->base_uri);
    }

}