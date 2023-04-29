<?php
/**
 * MCPL: Object
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! interface_exists( 'MCPL_Object' ) ) {
	interface MCPL_Object {
		public static function from( stdClass|array $obj ): static;
	}
}
