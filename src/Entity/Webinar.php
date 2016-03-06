<?php

namespace Slakbal\Citrix\Entity;


class Webinar extends EntityAbstract
{

    public $subject;
    public $description;
    public $times = [];
    public $timezone = 'Europe/Berlin';
    public $local;
    private $webinarKey;
    private $registrationUrl;
    private $participants;


    public function __construct($parameterArray = null)
    {
        if (isset($parameterArray) && is_array($parameterArray)) {

            $this->setSubject((isset($parameterArray[ 'subject' ]) ? $parameterArray[ 'subject' ] : null));
            $this->setDescription((isset($parameterArray[ 'description' ]) ? $parameterArray[ 'description' ] : ''));
            $this->setTimes(new Time($parameterArray[ 'startTime' ], $parameterArray[ 'endTime' ]));
            $this->setTimezone((isset($parameterArray[ 'timezone' ]) ? $parameterArray[ 'timezone' ] : $this->timezone));
            $this->setLocal((isset($parameterArray[ 'local' ]) ? $parameterArray[ 'local' ] : 'de_DE'));

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


    public function getLocal()
    {
        return $this->local;
    }


    public function setLocal($local)
    {
        $this->local = $local;
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