<?php

namespace Slakbal\Citrix\Entity;


class Webinar extends EntityAbstract
{

    public $subject;
    public $description;
    public $times = [];
    public $timezone = 'Europe/Berlin';
    public $type = 'single_session';
    public $isPasswordProtected = false;
    public $locale = 'de_DE';
    private $webinarKey;
    private $registrationUrl;
    private $participants;


    public function __construct($parameterArray = null)
    {
        if (isset($parameterArray) && is_array($parameterArray)) {

            $this->setSubject((isset($parameterArray['subject']) ? $parameterArray['subject'] : null));
            $this->setDescription((isset($parameterArray['description']) ? $parameterArray['description'] : ''));
            $this->setTimes(new Time($parameterArray['startTime'], $parameterArray['endTime']));
            $this->setTimezone((isset($parameterArray['timezone']) ? $parameterArray['timezone'] : $this->timezone));
            $this->setType((isset($parameterArray['type']) ? $parameterArray['type'] : $this->type));
            $this->setPasswordProtected((isset($parameterArray['isPasswordProtected']) ? $parameterArray['isPasswordProtected'] : $this->isPasswordProtected));
            $this->setLocale((isset($parameterArray['locale']) ? $parameterArray['locale'] : $this->locale));

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


    public function getLocale()
    {
        return $this->locale;
    }


    public function getType()
    {
        return $this->type;
    }


    public function setType($type)
    {
        $this->type = $type;
    }


    public function getPasswordProtected()
    {
        return $this->isPasswordProtected;
    }


    public function setPasswordProtected($isPasswordProtected)
    {
        $this->isPasswordProtected = $isPasswordProtected;
    }


    public function setLocale($locale)
    {
        $this->locale = $locale;
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