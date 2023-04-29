<?php
/**
 * Naran Boilerplate Core
 *
 * abstracts/registers/abstract-mcpl-register-base-rest-route.php
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Base_REST_Route' ) ) {
	abstract class MCPL_Register_Base_REST_Route implements MCPL_Register {
		use MCPL_Hook_Impl;

		/**
		 * Store real callbacks
		 *
		 * Callback may be a method of a lazy-load module, and you do not want to wake up that module so early.
		 *
		 * @var array
		 */
		private array $real_callbacks = [];

		/**
		 * Store real validators
		 *
		 * @var array
		 */
		private array $real_validators = [];

		/**
		 * Store real sanitizers
		 *
		 * @var array
		 */
		private array $real_sanitizers = [];

		/**
		 * Constructor method
		 */
		public function __construct() {
			$this->add_action( 'rest_api_init', 'register' );
		}

		/**
		 * Register all regs.
		 *
		 * @return void
		 */
		public function register(): void {
			$index = 0;

			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof MCPL_Reg_REST_Route ) {
					$item->args['mcpl'] = $index;

					// Switch callback.
					if ( isset( $item->args['callback'] ) ) {
						$this->real_callbacks[ $index ] = $item->args['callback'];
						$item->args['callback']         = [ $this, 'dispatch_request' ];
					}

					// Switch validator, and sanitizer.
					foreach ( $item->args['args'] as $key => $arg ) {
						if ( ! empty( $arg['validate_callback'] ) ) {
							$this->real_validators[ $index ][ $key ]         = $item->args['args'][ $key ]['validate_callback'];
							$item->args['args'][ $key ]['validate_callback'] = [ $this, 'dispatch_validator' ];
						}
						if ( ! empty( $arg['sanitize_callback'] ) ) {
							$this->real_sanitizers[ $index ][ $key ]         = $item->args['args'][ $key ]['sanitize_callback'];
							$item->args['args'][ $key ]['sanitize_callback'] = [ $this, 'dispatch_sanitizer' ];
						}
					}
					$item->register();

					++ $index;
				} elseif ( is_string( $item ) && is_subclass_of( $item, 'WP_REST_Controller' ) ) {
					$instance = new $item();
					$instance->register_routes();
				}
			}
		}

		/**
		 * Call cached, real validator.
		 */
		public function dispatch_validator( mixed $value, WP_REST_Request $request, string $key ): bool|WP_Error {
			$attributes = $request->get_attributes();

			try {
				if ( ! isset( $attributes['mcpl'] ) || ! isset( $this->real_validators[ $attributes['mcpl'] ] ) ) {
					throw new Exception();
				}
				$callback = mcpl_parse_callback( $this->real_validators[ $attributes['mcpl'] ][ $key ] );
				if ( is_callable( $callback ) ) {
					return call_user_func_array( $callback, [ $value, $request, $key ] );
				} else {
					throw new Exception();
				}
			} catch ( Exception $e ) {
				return new WP_Error(
					'mcpl_invlid_validator',
					sprintf( 'The validator of route \'%s\', param \'%s\' is invalid.', $request->get_route(), $key ),
					[ 'status' => 500 ]
				);
			}
		}

		/**
		 * Call cached, real sanitizer.
		 *
		 * @return mixed|WP_Error
		 */
		public function dispatch_sanitizer( mixed $value, WP_REST_Request $request, string $key ): mixed {
			$attributes = $request->get_attributes();

			try {
				if ( ! isset( $attributes['mcpl'] ) || ! isset( $this->real_sanitizers[ $attributes['mcpl'] ] ) ) {
					throw new Exception();
				}
				$callback = mcpl_parse_callback( $this->real_sanitizers[ $attributes['mcpl'] ][ $key ] );
				if ( is_callable( $callback ) ) {
					return call_user_func_array( $callback, [ $value, $request, $key ] );
				} else {
					throw new Exception();
				}
			} catch ( Exception $e ) {
				return new WP_Error(
					'mcpl_invlid_sanitizer',
					sprintf( 'The sanitizer of route \'%s\', param \'%s\' is invalid.', $request->get_route(), $key ),
					[ 'status' => 500 ]
				);
			}
		}

		/**
		 * Dispatch our real callback, return value as expected.
		 *
		 * @param WP_REST_Request $request
		 *
		 * @return mixed
		 */
		public function dispatch_request( WP_REST_Request $request ): mixed {
			$attributes = $request->get_attributes();

			try {
				if ( ! isset( $attributes['mcpl'] ) || ! isset( $this->real_callbacks[ $attributes['mcpl'] ] ) ) {
					throw new Exception();
				}
				$callback = mcpl_parse_callback( $this->real_callbacks[ $attributes['mcpl'] ] );
				if ( is_callable( $callback ) ) {
					return call_user_func( $callback, $request );
				} else {
					throw new Exception();
				}
			} catch ( Exception $e ) {
				return new WP_Error(
					'rest_invalid_handler',
					__( 'The handler for the route is invalid.' ),
					[ 'status' => 500 ]
				);
			}
		}
	}
}
