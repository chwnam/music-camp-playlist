<?php
/**
 * MCPL: Shortcode register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Shortcode' ) ) {
	class MCPL_Register_Shortcode extends MCPL_Register_Base_Shortcode {
		public function get_items(): Generator {
			yield; // yield new MCPL_Reg_Shortcode();
		}
	}
}
