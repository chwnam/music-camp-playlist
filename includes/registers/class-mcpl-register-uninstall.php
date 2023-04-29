<?php
/**
 * MCPL: Uninstall register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Uninstall' ) ) {
	class MCPL_Register_Uninstall extends MCPL_Register_Base_Uninstall {
		public function get_items(): Generator {
			yield; // yield new MCPL_Reg_Uninstall();
		}
	}
}
