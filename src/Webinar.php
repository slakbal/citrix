<?php


namespace Slakbal\Citrix;

use Slakbal\Citrix\Entity\Attendee;
use Slakbal\Citrix\Entity\Webinar as WebinarEntity;

class Webinar extends CitrixAbstract implements WebinarInterface
{

    public function __construct($authType = 'direct')
    {
        parent::__construct($authType = 'direct');
    }


    public function createWebinar($params)
    {
        $url = 'organizers/' . $this->getOrganizerKey() . '/webinars';

        $webinarObject = new WebinarEntity($params);

        $this->setHttpMethod('POST')->setUrl($url)->setParams($webinarObject->toArray())->sendRequest();

        return $this->getResponse();
    }


    public function getWebinar($webinarKey)
    {
        $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey;

        $this->setHttpMethod('GET')->setUrl($url)->sendRequest();

        return $this->getResponse();
    }


    public function deleteWebinar($webinarKey)
    {

        $url = 'organizers/' . $this->getOrganizerKey() . '/webinars/' . $webinarKey;

        $this->setHttpMethod('DELETE')->setUrl($url)->sendRequest();

        return $this->getResponse();
    }


    public function getUpcomingWebinars()
    {
        $url = 'organizers/' . $this->getOrganizerKey() . '/upcomingWebinars';

        $this->setHttpMethod('GET')->setUrl($url)->sendRequest();

        return $this->getResponse();
    }


    public function getAllWebinars()
    {
        $url = 'organizers/' . $this->getOrganizerKey() . '/webinars';

        $this->setHttpMethod('GET')->setUrl($url)->sendRequest();

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
        //dd( $attendeeObject->toArray());
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
}