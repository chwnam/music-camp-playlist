<?php
/**
 * Naran Boilerplate Core
 *
 * abstracts/registers/abstract-mcpl-register-base-widget.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Base_Widget' ) ) {
	abstract class MCPL_Register_Base_Widget implements MCPL_Register {
		use MCPL_Hook_Impl;

		/**
		 * Constructor method.
		 */
		public function __construct() {
			$this->add_action( 'widgets_init', 'register' );
		}

		public function register(): void {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof MCPL_Reg_Widget ) {
					$item->register();
				}
			}
		}
	}
}
