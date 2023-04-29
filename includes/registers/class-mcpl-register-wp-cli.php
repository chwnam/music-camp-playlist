<?php
/**
 * MCPL: WP-CLI register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_WP_CLI' ) ) {
	class MCPL_Register_WP_CLI extends MCPL_Register_Base_WP_CLI {
		public function get_items(): Generator {
			yield new MCPL_Reg_WP_CLI( 'mcpl', MCPL_CLI::class );
		}
	}
}
