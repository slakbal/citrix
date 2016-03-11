<?php

namespace Slakbal\Citrix;

use GuzzleHttp\Client as HttpClient;

class DirectAuthenticate
{

    protected $base_uri = 'https://api.citrixonline.com';//'https://api.citrixonline.com/G2W/rest';//'https://api.citrixonline.com/oauth/access_token';//

    protected $timeout = 5.0;

    protected $verify_ssl = false;

    protected $grant_type = 'password';

    protected $username;

    protected $password;

    protected $client_id;

    protected $client;

    protected $response;

    protected $statusCode;


    public function __construct()
    {
        $this->username  = config('citrix.direct.username');
        $this->password  = config('citrix.direct.password');
        $this->client_id = config('citrix.direct.client_id');
        $this->client    = new HttpClient([
            'base_uri' => $this->base_uri,
            'timeout'  => $this->timeout,
            'verify'   => $this->verify_ssl,
        ]);
    }


    public function authenticate()
    {
        $params = [
            'grant_type' => $this->grant_type,
            'user_id'    => $this->username,
            'password'   => $this->password,
            'client_id'  => $this->client_id,
        ];

        $this->response = $this->client->get('/oauth/access_token', [
            'header'      => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept'       => 'application/json',
            ],
            'query'       => $params,
            'form_params' => $params,
        ]);


        $this->statusCode = $this->response->getStatusCode();

        $this->response = $this->response->getBody();

        $this->response = json_decode($this->response, false, 512, JSON_BIGINT_AS_STRING);

        return $this->response;
    }

}