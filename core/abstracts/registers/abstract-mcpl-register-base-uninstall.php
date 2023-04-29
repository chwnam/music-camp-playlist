<?php
/**
 * Naran Boilerplate Core
 *
 * abstracts/registers/abstract-mcpl-register-base-uninstall.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Base_Uninstall' ) ) {
	abstract class MCPL_Register_Base_Uninstall implements MCPL_Register {
		/**
		 * Method name can mislead, but it does uninstall callback jobs.
		 *
		 * @return void
		 */
		public function register(): void {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof MCPL_Reg_Uninstall ) {
					$item->register();
				}
			}
		}
	}
}
