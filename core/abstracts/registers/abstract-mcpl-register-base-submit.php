<?php
/**
 * Naran Boilerplate Core
 *
 * abstracts/registers/abstract-mcpl-register-base-submit.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Base_Submit' ) ) {
	abstract class MCPL_Register_Base_Submit implements MCPL_Register {
		use MCPL_Autobind_Impl;
		use MCPL_Hook_Impl;

		/** 'admin-post.php' autobinding feature. */
		protected bool $autobind = true;

		private array $inner_handlers = [];

		/**
		 * Constructor method.
		 */
		public function __construct() {
			if ( mcpl_doing_submit() ) {
				$this->add_action( 'init', 'register' );
			}
		}

		/**
		 * @callback
		 * @actin       init
		 *
		 * @return void
		 */
		public function register(): void {
			foreach ( $this->get_items() as $item ) {
				if (
					$item instanceof MCPL_Reg_Submit &&
					$item->action &&
					! isset( $this->inner_handlers[ $item->action ] )
				) {
					$this->inner_handlers[ $item->action ] = $item->callback;
					$item->register( [ $this, 'dispatch' ] );
				}
			}

			// Autobind.
			if ( $this->is_autobind_enabled() ) {
				/** @uses handle_autobind() */
				$this->add_action( 'admin_init', 'handle_autobind' );
			}
		}

		public function dispatch(): void {
			// Boilerplate code cannot check nonce values.
			// phpcs:disable WordPress.Security.NonceVerification.Recommended
			$action = sanitize_key( $_REQUEST['action'] ?? '' );

			if ( $action && isset( $this->inner_handlers[ $action ] ) ) {
				try {
					$callback = mcpl_parse_callback( $this->inner_handlers[ $action ] );
					if ( is_callable( $callback ) ) {
						$callback();
					}
				} catch ( MCPL_Callback_Exception $e ) {
					$error = new WP_Error();
					$error->add(
						'mcpl_submit_error',
						sprintf(
							'Submit callback handler `%s` is invalid. Please check your submit register items.',
							mcpl_format_callable( $this->inner_handlers[ $action ] )
						)
					);
					// $error is a WP_Error instance.
					// phpcs:ignore WordPress.Security.EscapeOutput
					wp_die( $error, 404 );
				}
			}

			// phpcs:enable WordPress.Security.NonceVerification.Recommended
		}

		/**
		 * Return autobind enabled.
		 *
		 * @return bool
		 */
		public function is_autobind_enabled(): bool {
			return apply_filters( 'mcpl_submit_autobind_enabled', $this->autobind );
		}

		/**
		 * Handle autobind.
		 */
		public function handle_autobind(): void {
			$autobind = $this->parse_autobind();

			if ( $autobind ) {
				$dispatch = function () use ( $autobind ) {
					// Append NONCE check routine.
					if ( ! $autobind['exempt_nonce'] ) {
						check_admin_referer( $autobind['nonce_action'], '_mcpl_nonce' );
					}
					$autobind['callback']();
				};
				if ( $autobind['allow_nopriv'] ) {
					$this->add_action( "admin_post_nopriv_{$autobind['action']}", $dispatch );
				}
				$this->add_action( "admin_post_{$autobind['action']}", $dispatch );
			}
		}
	}
}
