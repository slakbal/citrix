<?php

namespace Slakbal\Citrix\Traits;

use Httpful\Request;
use Illuminate\Support\Facades\Log;
use Slakbal\Citrix\Exception\CitrixAuthenticateException;
use Slakbal\Citrix\Exception\CitrixException;

trait CitrixClient
{
    protected $G2W_uri = 'https://api.getgo.com/G2W/rest';

    protected $AUTH_uri = 'https://api.getgo.com';

    protected $timeout = 10; //seconds

    protected $verify_ssl = false;

    private $headers = [];

    private $response;

    private $message = '';


    //returns the body of the rest response
    function sendRequest($verb, $path, $parameters = null, $payload = null)
    {
        try {

            switch (strtoupper(trim($verb))) {

                case 'GET':

                    $this->response = Request::get($this->getUrl($this->G2W_uri, $path, $parameters))
                                             ->strictSSL($this->verify_ssl)
                                             ->addHeaders($this->determineHeaders())
                                             ->timeout($this->timeout)
                                             ->expectsJson()
                                             ->send();
                    break;

                case 'POST':

                    $this->response = Request::post($this->getUrl($this->G2W_uri, $path, $parameters))
                                             ->strictSSL($this->verify_ssl)
                                             ->addHeaders($this->determineHeaders())
                                             ->timeout($this->timeout)
                                             ->expectsJson()
                                             ->sendsJson()
                                             ->body($payload)
                                             ->send();
                    break;


                case 'PUT':

                    $this->response = Request::put($this->getUrl($this->G2W_uri, $path, $parameters))
                                             ->strictSSL($this->verify_ssl)
                                             ->addHeaders($this->determineHeaders())
                                             ->timeout($this->timeout)
                                             ->expectsJson()
                                             ->sendsJson()
                                             ->body($payload)
                                             ->send();
                    break;

                case 'DELETE':

                    $this->response = Request::delete($this->getUrl($this->G2W_uri, $path, $parameters))
                                             ->strictSSL($this->verify_ssl)
                                             ->addHeaders($this->determineHeaders())
                                             ->timeout($this->timeout)
                                             ->expectsJson()
                                             ->send();
                    break;

                default:

                    break;
            }
        } catch (\Exception $e) {

            Log::error('CITRIX: ' . $e->getMessage());

            throw new CitrixException($e->getMessage());
        }

        return $this->processResultCode($this->response);
    }


    //returns a single object (note not returning the body)
    function getAuthObject($verb, $path, $parameters = null, $payload = null)
    {
        try {

            $this->response = Request::get($this->getUrl($this->AUTH_uri, $path, $parameters))
                                     ->strictSSL($this->verify_ssl)
                                     ->addHeaders($this->determineHeaders())
                                     ->timeout($this->timeout)
                                     ->expectsJson()
                                     ->send();

        } catch (\Exception $e) {

            Log::error('CITRIX: ' . $e->getMessage());

            throw new CitrixAuthenticateException($e->getMessage());
        }

        return $this->response;
    }


    /**
     * @param $response
     *
     * @throws CitrixException
     */
    private function processResultCode($response)
    {
        //For anything other than a success log it and throw an exception eg. 401 Unauthorized, 403, etc
        if ($response->code != 200) {

            switch ($response->code) {

                case 204:
                    $this->message = 'No Content';
                    break;

                case 400:
                    $this->message = 'Bad Request';
                    break;

                case 403:
                    $this->message = 'Forbidden';
                    break;

                case 404:
                    $this->message = 'Not Found';
                    break;

                default:
                    break;
            }

            Log::error('CITRIX: ' . $this->message .' - '. $response->raw_body);

            throw new CitrixException($this->message .' - '. $response->raw_body);
        }

        return $response->body;
    }


    private function determineHeaders()
    {
        //if the accessObject exist it means the API can probably authenticate by token, thus add it to the headers
        if (cache()->has('CITRIX_ACCESS_OBJECT')) {
            $this->headers['Authorization'] = $this->getAccessToken();
        }

        return $this->headers;
    }


    function getUrl($baseUri, $path, $parameters = null)
    {
        if (is_null($parameters)) {
            return $this->getBasePath($baseUri, $path);
        }

        return $this->getBasePath($baseUri, $path) . '?' . http_build_query($parameters);
    }


    function getBasePath($baseUri, $path)
    {
        return trim($baseUri, '/') . '/' . trim($path, '/');
    }

}