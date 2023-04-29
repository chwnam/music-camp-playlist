<?php
/**
 * MCPL: Widget register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Widget' ) ) {
	class MCPL_Register_Widget extends MCPL_Register_Base_Widget {
		public function get_items(): Generator {
			yield; // yield new MCPL_Reg_Widget();
		}
	}
}
