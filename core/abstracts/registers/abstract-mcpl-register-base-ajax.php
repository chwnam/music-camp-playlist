<?php
/**
 * Naran Boilerplate Core
 *
 * abstracts/registers/abstract-mcpl-register-base-ajax.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Base_AJAX' ) ) {
	abstract class MCPL_Register_Base_AJAX implements MCPL_Register {
		use MCPL_Autobind_Impl;
		use MCPL_Hook_Impl;

		/** AJAX autobinding feature. */
		protected bool $autobind = true;

		private array $inner_handlers = [];

		private array $wc_ajax = [];

		/**
		 * Constructor method
		 */
		public function __construct() {
			if ( wp_doing_ajax() ) {
				$this->add_action( 'init', 'register' );
			}
		}

		/**
		 * Register regs
		 *
		 * @callback
		 * @actin       init
		 *
		 * @return void
		 */
		public function register(): void {
			foreach ( $this->get_items() as $item ) {
				if (
					$item instanceof MCPL_Reg_AJAX &&
					$item->action &&
					! isset( $this->inner_handlers[ $item->action ] )
				) {
					$this->inner_handlers[ $item->action ] = $item->callback;
					if ( $item->is_wc_ajax ) {
						$this->wc_ajax[ $item->action ] = true;
					}
					$item->register( [ $this, 'dispatch' ] );
				}
			}

			// Autobind.
			if ( $this->is_autobind_enabled() ) {
				/** @uses handle_autobind() */
				$this->add_action( 'admin_init', 'handle_autobind' );
			}
		}

		/**
		 * Generic callback method.
		 *
		 * @return void
		 */
		public function dispatch(): void {
			// Boilerplate code cannot check nonce values.
			// phpcs:disable WordPress.Security.NonceVerification.Recommended
			$action = sanitize_key( $_REQUEST['action'] ?? '' );

			// Action value may come from wc-ajax.
			if ( ! $action ) {
				$wc_ajax = sanitize_key( $_GET['wc-ajax'] ?? '' );
				if ( isset( $this->wc_ajax[ $wc_ajax ] ) ) {
					$action = $wc_ajax;
				}
			}

			if ( $action && isset( $this->inner_handlers[ $action ] ) ) {
				try {
					$callback = MCPL_Main::get_instance()->parse_callback( $this->inner_handlers[ $action ] );
					if ( is_callable( $callback ) ) {
						$callback();
					}
				} catch ( MCPL_Callback_Exception $e ) {
					$error = new WP_Error();
					$error->add(
						'mcpl_ajax_error',
						sprintf(
							'AJAX callback handler `%s` is invalid. Please check your AJAX register items.',
							mcpl_format_callable( $this->inner_handlers[ $action ] )
						)
					);
					wp_send_json_error( $error, 400 );
				}
			}

			// phpcs:enable WordPress.Security.NonceVerification.Recommended
		}

		/**
		 * Handle autobind as admin_init callback.
		 */
		public function handle_autobind(): void {
			$autobind = $this->parse_autobind();

			if ( $autobind ) {
				$dispatch = function () use ( $autobind ) {
					// Append NONCE check routine.
					if ( ! $autobind['exempt_nonce'] ) {
						check_ajax_referer( $autobind['nonce_action'], '_mcpl_nonce' );
					}
					$autobind['callback']();
				};
				if ( $autobind['allow_nopriv'] ) {
					$this->add_action( "wp_ajax_nopriv_{$autobind['action']}", $dispatch );
				}
				$this->add_action( "wp_ajax_{$autobind['action']}", $dispatch );
			}
		}

		/**
		 * Return autobind enabled.
		 *
		 * @return bool
		 */
		public function is_autobind_enabled(): bool {
			return apply_filters( 'mcpl_ajax_autobind_enabled', $this->autobind );
		}
	}
}
