<?php
/**
 * MCPL: Cron register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Cron' ) ) {
	class MCPL_Register_Cron extends MCPL_Register_Base_Cron {
		public function get_items(): Generator {
			yield new MCPL_Reg_Cron( time(), 'hourly', 'mcpl_playlist' );
			yield new MCPL_Reg_Cron( time(), 'every-05-min', 'mcpl_scrap_all' );
		}
	}
}
