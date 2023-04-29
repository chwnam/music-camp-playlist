<?php
/**
 * MCPL: Submit (admin-post.php) register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Submit' ) ) {
	class MCPL_Register_Submit extends MCPL_Register_Base_Submit {
		// Disable 'admin-post.php' autobind.
		// protected bool $autobind = false;

		public function get_items(): Generator {
			yield; // yield new MCPL_Reg_Submit();
		}
	}
}
