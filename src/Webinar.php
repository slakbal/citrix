<?php


namespace Slakbal\Citrix;

use Slakbal\Citrix\Entity\Attendee;
use Slakbal\Citrix\Entity\Webinar as WebinarEntity;

class Webinar extends CitrixAbstract
{

    public function __construct($authType = 'direct')
    {
        parent::__construct($authType = 'direct');
    }


    public function getUpcomingWebinars()
    {
        $path = 'organizers/' . $this->getOrganizerKey() . '/upcomingWebinars';

        return $this->sendRequest('GET', $path, $parameters = null, $payload = null);
    }


    public function getAllWebinars()
    {
        $path = 'organizers/' . $this->getOrganizerKey() . '/webinars';

        return $this->sendRequest('GET', $path, $parameters = null, $payload = null);
    }

    public function getWebinarRegistrants($webinarKey)
    {
        $path = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '/registrants';

        return $this->sendRequest('GET', $path, $parameters = null, $payload = null);
    }

    public function getWebinarAttendees($webinarKey)
    {
        $path = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '/attendees';

        return $this->sendRequest('GET', $path, $parameters = null, $payload = null);
    }



    /*

        //CREATE
        public function createWebinar($params)
        {
            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars';

            $webinarObject = new WebinarEntity($params);

            $this->setHttpMethod('POST')->setUrl($url)->setParams($webinarObject->toArray())->sendRequest();

            return $this->getResponse();
        }


        //READ
        public function getWebinar($webinarKey)
        {
            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey;

            $this->setHttpMethod('GET')->setUrl($url)->sendRequest();

            return $this->getResponse();
        }


        //UPDATE
        public function updateWebinar($webinarKey, $params, $sendNotification = true)
        {
            $notificationString = ($sendNotification) ? 'true' : 'false';

            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '?notifyParticipants=' . $notificationString;

            $webinarObject = new WebinarEntity($params);
            //dd($webinarObject->toArray());
            $this->setHttpMethod('PUT')->setUrl($url)->setParams($webinarObject->toArray())->sendRequest();

            return $this->getResponse();
        }


        //DELETE
        public function deleteWebinar($webinarKey, $sendNotification = true)
        {
            $notificationString = ($sendNotification) ? 'true' : 'false';

            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '?sendCancellationEmails=' . $notificationString;

            $this->setHttpMethod('DELETE')->setUrl($url)->sendRequest();

            return $this->getResponse();
        }







        public function getHistoricalWebinars($params)
        {
            $url = 'organizers/' . $this->getOrganizerKey() . '/historicalWebinars';

            $this->setHttpMethod('GET')->setUrl($url)->setParams($params)->sendRequest();

            return $this->getResponse();
        }


        public function getWebinarAttendees($webinarKey)
        {
            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '/attendees';

            $this->setHttpMethod('GET')->setUrl($url)->sendRequest();

            return $this->getResponse();
        }


        public function registerAttendee($webinarKey, $params)
        {
            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '/registrants';

            $attendeeObject = new Attendee($params);

            $this->setHttpMethod('POST')->setUrl($url)->setParams($attendeeObject->toArray())->sendRequest();

            return $this->getResponse();
        }


        public function getWebinarRegistrants($webinarKey)
        {
            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '/registrants';

            $this->setHttpMethod('GET')->setUrl($url)->sendRequest();

            return $this->getResponse();
        }


        public function getWebinarRegistrant($webinarKey, $registrantKey)
        {
            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '/registrants/' . $registrantKey;

            $this->setHttpMethod('GET')->setUrl($url)->sendRequest();

            return $this->getResponse();
        }


        public function deleteWebinarRegistrant($webinarKey, $registrantKey)
        {
            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '/registrants/' . $registrantKey;

            $this->setHttpMethod('DELETE')->setUrl($url)->sendRequest();

            return $this->getResponse();
        }


        public function getOrganizerSessions()
        {
            $url = 'organizers/' . $this->getOrganizerKey() . '/sessions';

            $this->setHttpMethod('GET')->setUrl($url)->sendRequest();

            return $this->getResponse();
        }


        public function getWebinarSessionAttendees($webinarKey, $sessionKey)
        {
            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '/sessions/' . $sessionKey . '/attendees';

            $this->setHttpMethod('GET')->setUrl($url)->sendRequest();

            return $this->getResponse();
        }


        public function getWebinarSessionAttendee($webinarKey, $sessionKey, $registrantKey)
        {
            $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey . '/sessions/' . $sessionKey . '/attendees/' . $registrantKey;

            $this->setHttpMethod('GET')->setUrl($url)->sendRequest();

            return $this->getResponse();
        }
    */
}
