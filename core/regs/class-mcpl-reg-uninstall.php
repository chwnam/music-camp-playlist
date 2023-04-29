<?php
/**
 * Naran Boilerplate Core
 *
 * regs/class-mcpl-reg-uninstall.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Reg_Uninstall' ) ) {
	class MCPL_Reg_Uninstall implements MCPL_Reg {
		/**
		 * Constructor method
		 */
		public function __construct(
			public Closure|array|string $callback,
			public array $args = [],
			public bool $error_log = false
		) {
		}

		/**
		 * Method name can mislead, but it does its uninstall callback job.
		 *
		 * @param null $dispatch
		 */
		public function register( $dispatch = null ): void {
			try {
				$callback = mcpl_parse_callback( $this->callback );
			} catch ( MCPL_Callback_Exception $e ) {
				$error = new WP_Error();
				$error->add(
					'mcpl_uninstall_error',
					sprintf(
						'Uninstall callback handler `%s` is invalid. Please check your uninstall register items.',
						$this->callback
					)
				);
				// $return is a WP_Error instance.
				// phpcs:ignore WordPress.Security.EscapeOutput
				wp_die( $error );
			}

			if ( $callback ) {
				if ( $this->error_log ) {
					error_log( error_log( sprintf( 'Uninstall callback started: %s', $this->callback ) ) );
				}

				$callback( $this->args );

				if ( $this->error_log ) {
					error_log( sprintf( 'Uninstall callback finished: %s', $this->callback ) );
				}
			}
		}
	}
}
