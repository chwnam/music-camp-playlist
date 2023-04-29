<?php
/**
 * MCPL: Style register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Style' ) ) {
	class MCPL_Register_Style extends MCPL_Register_Base_Style {
		/**
		 * Return Style regs.
		 *
		 * @return Generator
		 */
		public function get_items(): Generator {
			yield; // yield new MCPL_Reg_Style();
		}
	}
}
