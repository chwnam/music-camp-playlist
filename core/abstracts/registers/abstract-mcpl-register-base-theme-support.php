<?php
/**
 * Naran Boilerplate Core
 *
 * abstracts/registers/abstract-mcpl-register-theme-support.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Base_Theme_Support' ) ) {
	abstract class MCPL_Register_Base_Theme_Support implements MCPL_Register {
		use MCPL_Hook_Impl;

		/**
		 * Constructor method.
		 */
		public function __construct() {
			$this->add_action( 'after_setup_theme', 'register' );
		}

		/**
		 * @callback
		 * @actin       init
		 *
		 * @return void
		 */
		public function register(): void {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof MCPL_Reg_Theme_Support ) {
					$item->register();
				}
			}
			$this->extra_register();
		}
	}
}
