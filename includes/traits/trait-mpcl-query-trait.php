<?php
/**
 * MCPL: Query trait
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! trait_exists( 'MCPL_Object_Query_Trait' ) ) {
	trait MCPL_Object_Query_Trait {
		public static function from( array|stdClass $obj ): static {
			$instance = new static();

			$vars    = get_object_vars( $instance );
			$keys    = array_keys( $vars );
			$default = array_values( $vars );

			for ( $i = 0; $i < count( $vars ); ++ $i ) {
				$instance->{$keys[ $i ]} = mcpl_get_prop( $obj, $keys[ $i ], $default[ $i ] );
			}

			return $instance;
		}
	}
}
