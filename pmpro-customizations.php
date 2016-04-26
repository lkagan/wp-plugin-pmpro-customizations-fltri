<?php
/*
Plugin Name: Paid Membership Pro Customizations
Plugin URI: http://www.paidmembershipspro.com/wp/pmpro-customizations/
Description: Customizations to the Membership Functionality
Version: 1.0
Author: Superiocity
Author URI: http://www.superiocity.com
*/

namespace Superiocity\FLT;

class PMPro_Customizations {

	function init()
	{
		// don't break if Register Helper is not loaded
		if ( ! function_exists( '\pmprorh_add_registration_field' ) ) {
			return false;
		}

		// define the fields
		$fields   = array();
		
		$fields[] = new \PMProRH_Field(
			'zip',
			'text',
			array(
				'label'    => 'Zip code',
				'size'     => 5,
				'required' => true,
				'profile'  => true,
			) );

		$fields[] = new \PMProRH_Field(
			'gift',
			'select',
			array(
				'label'    => 'Free gift',
				'required' => true,
				'profile'  => true,
				'options'  => array(
					''      => '',
					'visor' => 'visor',
					'hat'   => 'hat',
				),
				'levels' => array( 1, 3, 4 ),
			) );
		
		$fields[] = new \PMProRH_Field(
			'shirt_size',
			'select',
			array(
				'label'   => 'Shirt size',
				'required' => true,
				'profile'  => true,
				'levels' => array( 1, 3 ),
				'options' => array(
					''         => '',
					'x-small'  => 'extra small',
					'small'    => 'small',
					'medium'   => 'medium',
					'large'    => 'large',
					'x-large'  => 'extra large',
				)
			) );
		
		//add the fields into a new checkout_boxes are of the checkout page
		foreach ( $fields as $field ) {
			pmprorh_add_registration_field(
				'checkout_boxes', // location on checkout page
				$field            // PMProRH_Field object
			);
		}
	}
}

add_action( 'init', array( 'Superiocity\FLT\PMPro_Customizations', 'init' ) );