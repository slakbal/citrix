<?php

namespace Slakbal\Citrix\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Slakbal\Citrix\DirectLogin;
use Slakbal\Citrix\Exception\CitrixAuthenticateException;

trait AccessObject
{

    private $authObject; //holds all the values returned after auth

    private $tokenExpiryMinutes = 7 * 24 * 60; //expire the authObject every 7 days - re-auth for a new one


    //check if API authentication object is available
    private function checkAccessObject($authType)
    {
        //If no Authenticate Object perform authentication to receive access object with tokens, etc.
        if (!$this->hasAccessObject()) {

            switch (strtolower($authType)) {

                case 'direct':

                    $this->directLogin();
                    break;

                case 'oauth2':

                    //not yet implemented
                    break;

                default:

                    $this->directLogin();
                    break;
            }

        }
        else {
            $this->authObject = cache()->get('CITRIX_ACCESS_OBJECT');
        }
    }


    /*
     * The Direct Login method should return a new AuthObject
     */
    private function directLogin()//todo make this private again... or check if there is a nice usecase for it to be public.... eg. renewal via a command?
    {
        $directAuth = new DirectLogin();

        try {

            $response = $directAuth->authenticate(); //the method returns the whole response object

        } catch (CitrixAuthenticateException $e) {

            $this->clearAccessObject(); //make sure the object is cleared from the cache to force a login retry
            throw $e; //bubble the exception up by rethrowing

        }

        $this->authObject = $response->body; //the authObject is in the body of the response object

        $this->rememberAccessObject($this->authObject); //cache the authObject

        Log::info('CITRIX: Successfully renewed AuthenticationObject');

        return $this->authObject;
    }


    private function rememberAccessObject($authObject)
    {
        cache()->put('CITRIX_ACCESS_OBJECT', $authObject, Carbon::now()->addMinutes($this->tokenExpiryMinutes));
    }


    function hasAccessObject()
    {
        if (cache()->has('CITRIX_ACCESS_OBJECT')) {
            return true;
        }

        return false;
    }


    function clearAccessObject()
    {
        cache()->forget('CITRIX_ACCESS_OBJECT');

        return $this;
    }


    function getOrganizerKey()
    {
        return $this->authObject->organizer_key;
    }


    function getAccountKey()
    {
        return $this->authObject->account_key;
    }


    function getAccessToken()
    {
        return $this->authObject->access_token;
    }


    function refreshToken()
    {
        $this->clearAccessObject(); //clear cached object

        $this->directLogin(); //perform fresh directLogin to get a new authObject

        return $this->authObject;
    }
}