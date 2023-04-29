<?php
/**
 * MCPL: Sidebar register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Sidebar' ) ) {
	class MCPL_Register_Sidebar extends MCPL_Register_Base_Sidebar {
		public function get_items(): Generator {
			yield; // yield new MCPL_Reg_Sidebar();
		}
	}
}
