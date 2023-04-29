<?php
/**
 * Naran Boilerplate Core
 *
 * regs/class-mcpl-reg-shortcode.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Reg_Shortcode' ) ) {
	class MCPL_Reg_Shortcode implements MCPL_Reg {
		/**
		 * Constructor method
		 */
		public function __construct(
			public string $tag,
			public Closure|array|string $callback,
			public Closure|array|string|null $heading_action = null
		) {
		}

		public function register( $dispatch = null ): void {
			add_shortcode( $this->tag, $dispatch );
		}
	}
}
