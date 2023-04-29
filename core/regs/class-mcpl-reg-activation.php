<?php
/**
 * Naran Boilerplate Core
 *
 * regs/class-mcpl-reg-activation.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Reg_Activation' ) ) {
	class MCPL_Reg_Activation implements MCPL_Reg {
		/**
		 * Constructor method.
		 *
		 * @param Closure|array|string $callback  Callback for activation.
		 * @param array                $args      Arguments for callback function.
		 * @param bool                 $error_log Use error_log.
		 */
		public function __construct(
			public Closure|array|string $callback,
			public array $args = [],
			public bool $error_log = false
		) {
		}

		/**
		 * Method name can mislead, but it does its activation callback job.
		 *
		 * @param null $dispatch Unused.
		 *
		 * @return void
		 */
		public function register( $dispatch = null ): void {
			try {
				$callback = MCPL_Main::get_instance()->parse_callback( $this->callback );
			} catch ( MCPL_Callback_Exception $e ) {
				$error = new WP_Error();
				$error->add(
					'mcpl_activation_error',
					sprintf(
						'Activation callback handler `%s` is invalid. Please check your activation register items.',
						mcpl_format_callable( $this->callback )
					)
				);
				// $error is a WP_Error instance.
				// phpcs:ignore WordPress.Security.EscapeOutput
				wp_die( $error );
			}

			if ( $callback ) {
				if ( $this->error_log ) {
					error_log( sprintf( 'Activation callback started: %s', mcpl_format_callable( $this->callback ) ) );
				}

				call_user_func_array( $callback, $this->args );

				if ( $this->error_log ) {
					error_log( sprintf( 'Activation callback finished: %s', mcpl_format_callable( $this->callback ) ) );
				}
			}
		}
	}
}
