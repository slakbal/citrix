<?php


namespace Slakbal\Citrix;

use Slakbal\Citrix\Entity\Attendee;
use Slakbal\Citrix\Entity\Webinar as WebinarEntity;

class Webinar extends CitrixAbstract
{

    function __construct($authType = 'direct')
    {
        parent::__construct($authType = 'direct');
    }


    /*
     * Retrieves the list of webinars for an account within a given date range.
     * Page and size parameters are optional.
     * Default page is 0 and default size is 20.
     */
    function getAllWebinars($parameters = null)
    {
        $path = 'organizers/' . $this->getOrganizerKey() . '/webinars';

        return $this->sendRequest('GET', $path, $parameters, $payload = null);
    }


    /*
     * Returns webinars scheduled for the future for the configured organizer and webinars
     * of other organizers where the configured organizer is a co-organizer.
     */
    function getUpcomingWebinars()
    {
        $path = 'organizers/' . $this->getOrganizerKey() . '/upcomingWebinars';

        return $this->sendRequest('GET', $path, $parameters = null, $payload = null);
    }


    /*
     * Returns details for completed webinars.
     */
    function getHistoricalWebinars($parameters = null)
    {
        $path = 'organizers/' . $this->getOrganizerKey() . '/historicalWebinars';

        return $this->sendRequest('GET', $path, $parameters, $payload = null);
    }


    /*
     * Retrieve information on a specific webinar.
     * If the type of the webinar is 'sequence', a sequence of future times will be provided.
     * Webinars of type 'series' are treated the same as normal webinars - each session in the webinar series has a different webinarKey.
     * If an organizer cancels a webinar, then a request to get that webinar would return a '404 Not Found' error.
     */
    function getWebinar($webinarKey)
    {
        $path = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey;

        return $this->sendRequest('GET', $path, $parameters = null, $payload = null);
    }


    /*
     * Retrieve registration details for all registrants of a specific webinar.
     * Registrant details will not include all fields captured when creating the registrant.
     * To see all data, use the API call 'Get Registrant'. Registrants can have one of the following states;
     * WAITING - registrant registered and is awaiting approval (where organizer has required approval),
     * APPROVED - registrant registered and is approved, and
     * DENIED - registrant registered and was denied.
     */
    function getWebinarRegistrants($webinarKey)
    {
        $path = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '/registrants';

        return $this->sendRequest('GET', $path, $parameters = null, $payload = null);
    }


    /*
     * Retrieve registration details for a specific registrant.
     */
    function getWebinarRegistrant($webinarKey, $registrantKey)
    {
        $path = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '/registrants/' . $registrantKey;

        return $this->sendRequest('GET', $path, $parameters = null, $payload = null);
    }


    /*
     * Returns all attendees for all sessions of the specified webinar.
     */
    function getWebinarAttendees($webinarKey)
    {
        $path = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '/attendees';

        return $this->sendRequest('GET', $path, $parameters = null, $payload = null);
    }


    /*
     * Creates a single session webinar.
     * The response provides a numeric webinarKey in string format for the new webinar. Once a webinar has been created with this method, you can accept registrations.
     */
    function createWebinar($parameters)
    {
        $path = 'organizers/' . $this->getOrganizerKey() . '/webinars';

        $webinarObject = new WebinarEntity($parameters);

        return $this->sendRequest('POST', $path, $parameters = null, $payload = $webinarObject->toArray());
    }


    /*
     * Cancels a specific webinar. If the webinar is a series or sequence, this call deletes all scheduled sessions.
     * To send cancellation emails to registrants set sendCancellationEmails=true in the request.
     * When the cancellation emails are sent, the default generated message is used in the cancellation email body.
     */
    function deleteWebinar($webinarKey, $sendCancellationEmails = true)
    {
        $parameters = [];

        if ($sendCancellationEmails) {
            $parameters = [
                'sendCancellationEmails' => 'true',
            ];
        }
//todo use fidler and check if the parameter is applied to the delete request.
        $path = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey;

        return $this->sendRequest('DELETE', $path, $parameters, $payload = null);
    }

    /*

        //CREATE
        function createWebinar($params)
        {
            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars';

            $webinarObject = new WebinarEntity($params);

            $this->setHttpMethod('POST')->setUrl($url)->setParams($webinarObject->toArray())->sendRequest();

            return $this->getResponse();
        }



        //UPDATE
        function updateWebinar($webinarKey, $params, $sendNotification = true)
        {
            $notificationString = ($sendNotification) ? 'true' : 'false';

            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '?notifyParticipants=' . $notificationString;

            $webinarObject = new WebinarEntity($params);
            //dd($webinarObject->toArray());
            $this->setHttpMethod('PUT')->setUrl($url)->setParams($webinarObject->toArray())->sendRequest();

            return $this->getResponse();
        }


        //DELETE
        function deleteWebinar($webinarKey, $sendNotification = true)
        {
            $notificationString = ($sendNotification) ? 'true' : 'false';

            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '?sendCancellationEmails=' . $notificationString;

            $this->setHttpMethod('DELETE')->setUrl($url)->sendRequest();

            return $this->getResponse();
        }


        function registerAttendee($webinarKey, $params)
        {
            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '/registrants';

            $attendeeObject = new Attendee($params);

            $this->setHttpMethod('POST')->setUrl($url)->setParams($attendeeObject->toArray())->sendRequest();

            return $this->getResponse();
        }



        function deleteWebinarRegistrant($webinarKey, $registrantKey)
        {
            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '/registrants/' . $registrantKey;

            $this->setHttpMethod('DELETE')->setUrl($url)->sendRequest();

            return $this->getResponse();
        }


        function getOrganizerSessions()
        {
            $url = 'organizers/' . $this->getOrganizerKey() . '/sessions';

            $this->setHttpMethod('GET')->setUrl($url)->sendRequest();

            return $this->getResponse();
        }


        function getWebinarSessionAttendees($webinarKey, $sessionKey)
        {
            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '/sessions/' . $sessionKey . '/attendees';

            $this->setHttpMethod('GET')->setUrl($url)->sendRequest();

            return $this->getResponse();
        }


        function getWebinarSessionAttendee($webinarKey, $sessionKey, $registrantKey)
        {
            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '/sessions/' . $sessionKey . '/attendees/' . $registrantKey;

            $this->setHttpMethod('GET')->setUrl($url)->sendRequest();

            return $this->getResponse();
        }
    */
}
