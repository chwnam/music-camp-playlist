<?php
/**
 * MCPL: Activation register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Activation' ) ) {
	class MCPL_Register_Activation extends MCPL_Register_Base_Activation {
		public function get_items(): Generator {
			yield; // new MCPL_Reg_Activation( 'registers.role@register' );
		}
	}
}
