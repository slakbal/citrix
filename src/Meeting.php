<?php


namespace Slakbal\Citrix;


class Meeting extends CitrixAbstract implements MeetingInterface
{

    public function __construct($authType = 'direct')
    {
        parent::__construct($authType = 'direct');
    }

}