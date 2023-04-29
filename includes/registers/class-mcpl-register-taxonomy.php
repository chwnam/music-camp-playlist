<?php
/**
 * MCPL: Custom taxonomy register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Taxonomy' ) ) {
	class MCPL_Register_Taxonomy extends MCPL_Register_Base_Taxonomy {
		public function get_items(): Generator {
			yield; // yield new MCPL_Reg_Taxonomy();
		}
	}
}
