<?php
/**
 * MCPL: Block register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Block' ) ) {
	class MCPL_Register_Block extends MCPL_Register_Base_Block {
		public function get_items(): Generator {
			yield; // yield new MCPL_Reg_Block();
		}
	}
}
