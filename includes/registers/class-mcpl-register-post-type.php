<?php
/**
 * MCPL: Custom post type register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Post_Type' ) ) {
	class MCPL_Register_Post_Type extends MCPL_Register_Base_Post_Type {
		public function get_items(): Generator {
			yield; // yield new MCPL_Reg_Post_Type();
		}
	}
}
