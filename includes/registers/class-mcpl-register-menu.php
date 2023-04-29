<?php
/**
 * MCPL: Menu register.
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Menu' ) ) {
	class MCPL_Register_Menu extends MCPL_Register_Base_Menu {
		public function get_items(): Generator {
			yield;
			// yield new MCPL_Reg_Menu();
			// yield new MCPL_Reg_Submenu();
		}
	}
}
