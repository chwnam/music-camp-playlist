<?php
/**
 * Naran Boilerplate Core
 *
 * abstracts/registers/abstract-mcpl-register-base-script.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Base_Script' ) ) {
	abstract class MCPL_Register_Base_Script implements MCPL_Register {
		use MCPL_Hook_Impl;

		/**
		 * Constructor method.
		 */
		public function __construct() {
			$this->add_action( 'init', 'register' );
		}

		/**
		 * @callback
		 * @action       init
		 *
		 * @return void
		 */
		public function register(): void {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof MCPL_Reg_Script ) {
					$item->register();
				}
			}
		}

		/**
		 * @param string $rel_path
		 * @param bool   $replace_min
		 *
		 * @return string
		 */
		protected function src_helper( string $rel_path, bool $replace_min = true ): string {
			$rel_path = trim( $rel_path, '\\/' );

			if ( $replace_min && mcpl_script_debug() && str_ends_with( $rel_path, '.min.js' ) ) {
				$rel_path = substr( $rel_path, 0, - 7 ) . '.js';
			}

			if ( mcpl_is_theme() ) {
				return get_stylesheet_directory_uri() . "/assets/js/$rel_path";
			} else {
				return plugin_dir_url( mcpl_main_file() ) . "assets/js/$rel_path";
			}
		}
	}
}
