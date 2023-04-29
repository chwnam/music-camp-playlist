<?php
/**
 * Naran Boilerplate Core
 *
 * interfaces/interface-mcpl-register.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! interface_exists( 'MCPL_Register' ) ) {
	interface MCPL_Register {
		/**
		 * Get list of regs.
		 */
		public function get_items(): Generator;

		/**
		 * Register all regs.
		 */
		public function register();
	}
}
