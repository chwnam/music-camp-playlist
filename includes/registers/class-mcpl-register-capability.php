<?php
/**
 * MCPL: Role register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class_alias( MCPL_Reg_Capability::class, 'MCPL_Reg_Cap' );

if ( ! class_exists( 'MCPL_Register_Capability' ) ) {
	class MCPL_Register_Capability extends MCPL_Register_Base_Capability {
		public function get_items(): Generator {
			yield; // yield new MCPL_Reg_Cap();
		}
	}
}
