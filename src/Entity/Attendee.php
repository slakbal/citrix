<?php

namespace Slakbal\Citrix\Entity;


class Attendee extends EntityAbstract
{

    public $firstName;

    public $lastName;

    public $email;

    public $organization;


    public function __construct($parameterArray = null)
    {
        if (isset($parameterArray) && is_array($parameterArray)) {

            $this->setFirstName($parameterArray[ 'firstName' ]);
            $this->setLastName($parameterArray[ 'lastName' ]);
            $this->setEmail($parameterArray[ 'email' ]);
            (isset($parameterArray[ 'organization' ]) ? $this->setOrganization($parameterArray[ 'organization' ]) : null);

        }
    }


    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }


    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function setOrganization($organization)
    {
        $this->organization = $organization;
    }

}