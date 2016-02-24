<?php

namespace Slakbal\Citrix\Entity;


class Attendee extends EntityAbstract
{

	public $firstName;

	public $lastName;

	public $email;

	public $organization;


	public function __construct( $parameterArray = null )
	{
		if ( isset( $parameterArray ) && is_array( $parameterArray ) ) {
			$this->setFirstName( $parameterArray[ 'firstname' ] );
			$this->setLastName( $parameterArray[ 'lastname' ] );
			$this->setEmail( $parameterArray[ 'email' ] );
			( isset( $parameterArray[ 'organization' ] ) ? $this->setOrganization( $parameterArray[ 'organization' ] ) : null );
		}
	}


	public function setFirstName( $firstname )
	{
		$this->firstName = $firstname;
	}

	public function setLastName( $lastname )
	{
		$this->lastName = $lastname;
	}

	public function setEmail( $email )
	{
		$this->email = $email;
	}

	public function setOrganization( $organization )
	{
		$this->organization = $organization;
	}

}