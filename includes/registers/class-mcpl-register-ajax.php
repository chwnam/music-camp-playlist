<?php
/**
 * MCPL: AJAX (admin-ajax.php, or wc-ajax) register.
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_AJAX' ) ) {
	class MCPL_Register_AJAX extends MCPL_Register_Base_AJAX {
		// Disable AJAX autobind.
		// protected bool $autobind = false;

		public function get_items(): Generator {
			yield; // yield new MCPL_Reg_AJAX();
		}
	}
}
