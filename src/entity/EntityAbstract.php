<?php

namespace Slakbal\Citrix\Entity;


class EntityAbstract
{


	public function toArray()
	{
		//list of variables to be skipped
		$toUnset = [ 'webinarKey',
		             'registrationUrl',
		             'participants' ];

		$toArray = get_object_vars( $this );

		foreach ( $toUnset as $value ) {
			if ( isset( $toArray[ $value ] ) ) {
				unset( $toArray[ $value ] );
			}
		}

		return $toArray;
	}


}