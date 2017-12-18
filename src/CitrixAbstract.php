<?php

namespace Slakbal\Citrix;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Facades\Cache;

/**
 * Provides common functionality for Citrix classes
 *
 * @abstract
 */
abstract class CitrixAbstract
{

    private $base_uri = 'https://api.getgo.com/G2W/rest/';

    private $port = 443;

    private $timeout = 5.0;

    private $verify_ssl = false;

    private $client;

    private $authObject; //holds all the values after auth

    private $tokenExpiryMinutes = 7 * 24 * 60; //expire the token every 7 days - re-auth for a new one

    private $httpMethod = 'GET';

    private $params = [];

    private $url;

    private $httpResponse;

    private $response;

    private $status;


    public function __construct($authType)
    {
        //If no Authenticate Object perform authentication to receive access object with tokens, etc.
        if (!$this->hasAccessObject()) {

            switch (strtolower($authType)) {

                case 'direct':

                    $this->directAuthentication();
                    break;

                case 'oauth2':

                    $this->oauth2Authentication();
                    break;

                default:

                    $this->directAuthentication();
                    break;
            }

        } else {

            $this->authObject = Cache::get('citrix_access_object');
        }
    }


    public function hasAccessObject()
    {
        if (Cache::has('citrix_access_object')) {
            return true;
        }

        return false;
    }


    private function directAuthentication()
    {
        $directAuth = new DirectAuthenticate();

        $this->authObject = $directAuth->authenticate();
        $this->rememberAccessObject($this->authObject);
    }


    public function rememberAccessObject($authObject)
    {
        Cache::put('citrix_access_object', $authObject, $this->tokenExpiryMinutes);
    }


    private function oauth2Authentication()
    {
        //to be implemented
        $this->authObject = null;
        Cache::forget('citrix_access_object');
    }


    public function getOrganizerKey()
    {
        return $this->authObject->organizer_key;
    }


    public function getAccountKey()
    {
        return $this->authObject->account_key;
    }


    public function getRefreshToken()
    {
        return $this->authObject->refresh_token;
    }


    public function getAuthObject()
    {
        return $this->authObject;
    }


    public function getStatus()
    {
        return $this->status;
    }


    public function addParam($key, $value)
    {
        $this->params[ $key ] = $value;

        return $this;
    }


    public function getResponse()
    {
        return $this->response;
    }


    public function setResponse($response)
    {
        if (is_object($response)) {

            $this->response = $response;

            return $this;
        }

        $this->response = (array)json_decode($response, true, 512);

        return $this;

    }


    public function getResponseCollection()
    {
        return collect($this->response);
    }


    public function sendRequest()
    {

        if (!$this->client instanceof HttpClient) {

            $this->client = new HttpClient([
                'base_uri' => $this->base_uri,
                'port'     => $this->port,
                'timeout'  => $this->timeout,
                'verify'   => $this->verify_ssl,
            ]);

        };

        try {

            switch ($this->getHttpMethod()) {

                case 'GET':

                    $this->httpResponse = $this->client->get($this->getUrl(), [
                        'headers' => [
                            'Content-Type'  => 'application/json; charset=utf-8',
                            'Accept'        => 'application/json',
                            'Authorization' => 'OAuth oauth_token=' . $this->getAccessToken(),
                        ],
                        'query'   => $this->getParams(),
                    ]);
                    break;

                case 'POST':

                    $this->httpResponse = $this->client->post($this->getUrl(), [
                        'headers' => [
                            'Content-Type'  => 'application/json; charset=utf-8',
                            'Accept'        => 'application/json',
                            'Authorization' => 'OAuth oauth_token=' . $this->getAccessToken(),
                        ],
                        'json'    => $this->getParams(),
                    ]);
                    break;

                case 'PUT':

                    $this->httpResponse = $this->client->put($this->getUrl(), [
                        'headers' => [
                            'Content-Type'  => 'application/json; charset=utf-8',
                            'Accept'        => 'application/json',
                            'Authorization' => 'OAuth oauth_token=' . $this->getAccessToken(),
                        ],
                        'json'    => $this->getParams(),
                    ]);
                    break;

                case 'DELETE':

                    $this->httpResponse = $this->client->delete($this->getUrl(), [
                        'headers' => [
                            'Content-Type'  => 'application/json; charset=utf-8',
                            'Accept'        => 'application/json',
                            'Authorization' => 'OAuth oauth_token=' . $this->getAccessToken(),
                        ],
                    ]);
                    break;

                default:

                    break;
            }
        } catch (\Exception $e) {

            $this->response = (object)[
                'error'   => (bool)true,
                'message' => $e->getMessage(),
            ];

            return $this;

        }

        //if no error carry on to build the response
        $this->response = (object)[
            'error'  => (bool)false,
            'status' => $this->httpResponse->getStatusCode(),
            'body'   => $this->parseBody($this->httpResponse->getBody()),
        ];

        return $this;
    }


    public function getHttpMethod()
    {
        return $this->httpMethod;
    }


    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = strtoupper($httpMethod);

        return $this;
    }


    public function getUrl()
    {
        return $this->url;
    }


    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }


    public function getAccessToken()
    {
        return $this->authObject->access_token;
    }


    public function getParams()
    {
        return $this->params;
    }


    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }


    public function parseBody($body)
    {
        return json_decode($body, false, 512, JSON_BIGINT_AS_STRING);
    }

}