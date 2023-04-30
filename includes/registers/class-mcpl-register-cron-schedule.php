<?php
/**
 * MCPL: Cron schedule register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Cron_Schedule' ) ) {
	class MCPL_Register_Cron_Schedule extends MCPL_Register_Base_Cron_Schedule {
		public function get_items(): Generator {
			yield new MCPL_Reg_Cron_Schedule( 'every-05-min', 5 * MINUTE_IN_SECONDS, '매5분');
		}
	}
}
