<?php
/**
 * MCPL: Deactivation register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Deactivation' ) ) {
	class MCPL_Register_Deactivation extends MCPL_Register_Base_Deactivation {
		public function get_items(): Generator {
			// Remove defined roles
			yield new MCPL_Reg_Activation( 'registers.role@unregister' );

			// Remove defined caps
			yield new MCPL_Reg_Activation( 'registers.cap@unregister' );
		}
	}
}
