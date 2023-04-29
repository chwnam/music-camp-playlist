<?php
/**
 * Naran Boilerplate Core
 *
 * regs/class-mcpl-reg-cron-schedule.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Reg_Cron_Schedule' ) ) {
	class MCPL_Reg_Cron_Schedule implements MCPL_Reg {
		/**
		 * Constructor method
		 */
		public function __construct(
			public string $name,
			public int $interval,
			public string $display
		) {
		}

		public function register( $dispatch = null ): void {
			// Do nothing.
		}
	}
}
