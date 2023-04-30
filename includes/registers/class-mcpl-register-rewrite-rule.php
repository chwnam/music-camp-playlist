<?php
/**
 * MCPL: rewrite rule register
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Rewrite_Rule' ) ) {
	class MCPL_Register_Rewrite_Rule extends MCPL_Register_Base_Rewrite_Rule {
		/**
		 * Get rewrite rule regs.
		 *
		 * @return Generator
		 */
		public function get_items(): Generator {
			yield from MCPL_Rewrite_Handlers::get_regs();
		}
	}
}
