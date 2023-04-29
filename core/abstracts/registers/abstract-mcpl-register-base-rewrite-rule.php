<?php
/**
 * Naran Boilerplate Core
 *
 * abstracts/registers/abstract-mcpl-register-base-rewrite-rule.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Base_Rewrite_Rule' ) ) {
	abstract class MCPL_Register_Base_Rewrite_Rule implements MCPL_Register {
		use MCPL_Hook_Impl;

		private array $bindings = [];

		private array $query_vars = [];

		/**
		 * Constructor method.
		 */
		public function __construct() {
			$this->add_action( 'init', 'register' );
		}

		public function register(): void {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof MCPL_Reg_Rewrite_Rule ) {
					$item->register();
					if ( $item->binding ) {
						$this->bindings[ $item->regex ] = $item->binding;
					}
					if ( $item->query_vars ) {
						$this->query_vars[] = $item->query_vars;
					}
				}
			}

			if ( $this->bindings ) {
				$this->add_action( 'template_redirect', 'handle_binding' );
			}

			$this->query_vars = array_unique( array_filter( array_merge( ...$this->query_vars ) ) );
			if ( $this->query_vars ) {
				$this->add_filter( 'query_vars', 'add_query_vars' );
			}
		}

		/**
		 * Callback for matched URL.
		 *
		 * @callback
		 * @action   template_redirect
		 *
		 * @return void
		 */
		public function handle_binding(): void {
			global $wp;

			if ( ( $binding = $this->bindings[ $wp->matched_rule ] ?? null ) ) {
				try {
					$callback = MCPL_Main::get_instance()->parse_callback( $binding );
				} catch ( MCPL_Callback_Exception $e ) {
					// WP_Error instance.
					// phpcs:disable WordPress.Security.EscapeOutput
					wp_die(
						new WP_Error(
							'snp_rewrite_rule_error',
							/* translators: formatted callback */
							sprintf( __( 'Rewrite rule binding `%s` is invalid. Please check your rewrite rule register items.', 'mcpl' ), mcpl_format_callable( $binding ) )
						)
					);
					// phpcs:enable WordPress.Security.EscapeOutput
				}

				$callback();

				if ( apply_filters( 'mcpl_register_rewrite_rule_exit', true, $wp->matched_rule ) ) {
					exit;
				}
			}
		}

		public function add_query_vars( array $query_vars ): array {
			return array_merge( $query_vars, $this->query_vars );
		}
	}
}
