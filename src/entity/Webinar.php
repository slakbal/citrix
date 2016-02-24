<?php

namespace Slakbal\Citrix\Entity;


class Webinar extends EntityAbstract
{

    public $subject;
    public $description;
    public $times = [];
    public $timezone = 'Europe/Berlin';
    private $webinarKey;
    private $registrationUrl;
    private $participants;


    public function __construct($parameterArray = null)
    {
        if (isset($parameterArray) && is_array($parameterArray)) {

            $this->setSubject($parameterArray[ 'subject' ]);
            (isset($parameterArray[ 'description' ]) ? $this->setDescription($parameterArray[ 'description' ]) : null);
            $this->setTimes(new Time($parameterArray[ 'startTime' ], $parameterArray[ 'endTime' ]));
            (isset($parameterArray[ 'timezone' ]) ? $this->setTimezone($parameterArray[ 'timezone' ]) : null);
            
        }
    }


    public function getSubject()
    {
        return $this->subject;
    }


    public function setSubject($subject)
    {
        $this->subject = $subject;
    }


    public function getDescription()
    {
        return $this->description;
    }


    public function setDescription($description)
    {
        $this->description = $description;
    }


    public function getTimezone()
    {
        return $this->timezone;
    }


    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }


    public function getTimes()
    {
        return $this->times;
    }


    public function setTimes($timeObject)
    {
        $this->times[] = $timeObject;
    }


    public function getRegistrationURL()
    {
        return $this->registrationUrl;
    }


    public function setRegistrationURL($url)
    {
        $this->registrationUrl = $url;
    }


    public function getParticipants()
    {
        return $this->participants;
    }


    public function setParticipants($participants)
    {
        $this->participants = $participants;
    }


    public function getWebinarKey()
    {
        return $this->webinarKey;
    }


    public function setWebinarKey($webinarKey)
    {
        $this->webinarKey = $webinarKey;
    }

}