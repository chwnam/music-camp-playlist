<?php
/**
 * MCPL: Script register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Script' ) ) {
	class MCPL_Register_Script extends MCPL_Register_Base_Script {
		public function get_items(): Generator {
			yield; // yield new MCPL_Reg_Script();
		}
	}
}
