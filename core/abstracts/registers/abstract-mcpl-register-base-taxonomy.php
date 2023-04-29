<?php
/**
 * Naran Boilerplate Core
 *
 * abstracts/registers/abstract-mcpl-register-base-taxonomy.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Base_Taxonomy' ) ) {
	abstract class MCPL_Register_Base_Taxonomy implements MCPL_Register {
		use MCPL_Hook_Impl;

		/**
		 * Constructor method.
		 */
		public function __construct() {
			$this->add_action( 'init', 'register' );
		}

		/**
		 * @callback
		 * @actin       init
		 *
		 * @return void
		 */
		public function register(): void {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof MCPL_Reg_Taxonomy ) {
					$item->register();
				}
			}
		}
	}
}
