<?php
/**
 * MCPL: Role register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Role' ) ) {
	class MCPL_Register_Role extends MCPL_Register_Base_Role {
		public function get_items(): Generator {
			yield; // yield new MCPL_Reg_Role();
		}
	}
}
