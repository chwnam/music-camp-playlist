<?php
/**
 * Naran Boilerplate Core
 *
 * abstracts/registers/abstract-mcpl-register-base-deactivation.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Base_Deactivation' ) ) {
	abstract class MCPL_Register_Base_Deactivation implements MCPL_Register {
		use MCPL_Hook_Impl;

		/**
		 * Constructor method.
		 */
		public function __construct() {
			$this->add_action( 'mcpl_deactivation', 'register' );
		}

		/**
		 * Method name can mislead, but it does deactivation callback jobs.
		 *
		 * @return void
		 */
		public function register(): void {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof MCPL_Reg_Deactivation ) {
					$item->register();
				}
			}
		}
	}
}
