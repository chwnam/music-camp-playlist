<?php
/**
 * Naran Boilerplate Core
 *
 * interfaces/interface-mcpl-reg.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! interface_exists( 'MCPL_Reg' ) ) {
	interface MCPL_Reg {
		public function register( $dispatch = null );
	}
}
