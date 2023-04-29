<?php
/**
 * Naran Boilerplate Core
 *
 * regs/class-mcpl-reg-post-type.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Reg_Post_Type' ) ) {
	class MCPL_Reg_Post_Type implements MCPL_Reg {
		/**
		 * Constructor method
		 *
		 * @param string $post_type
		 * @param array  $args
		 */
		public function __construct(
			public string $post_type,
			public array $args
		) {
		}

		public function register( $dispatch = null ): void {
			if ( ! post_type_exists( $this->post_type ) ) {
				$return = register_post_type( $this->post_type, $this->args );
				if ( is_wp_error( $return ) ) {
					// $return is a WP_Error instance.
					// phpcs:ignore WordPress.Security.EscapeOutput
					wp_die( $return );
				}
			}
		}
	}
}
