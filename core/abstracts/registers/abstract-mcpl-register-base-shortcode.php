<?php
/**
 * Naran Boilerplate Core
 *
 * abstracts/registers/abstract-mcpl-register-base-shortcode.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Base_Shortcode' ) ) {
	abstract class MCPL_Register_Base_Shortcode implements MCPL_Register {
		use MCPL_Hook_Impl;

		/**
		 * @var array{string: callable|array|string}
		 */
		private array $real_callbacks;

		/**
		 * @var array{string|string, callable|array|string}
		 */
		private array $heading_actions;

		/**
		 * @var string[]
		 */
		private array $found_tags;

		/**
		 * Regular expression for finding shortcodes in post_content.
		 *
		 * @var string
		 */
		private string $regex;

		/**
		 * Constructor method.
		 */
		public function __construct() {
			$this
				->add_action( 'init', 'register' )
				->add_action( 'wp', 'heading_actions_handler' )
			;

			$this->real_callbacks  = [];
			$this->heading_actions = [];
			$this->found_tags      = [];
			$this->regex           = '';
		}

		public function register(): void {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof MCPL_Reg_Shortcode ) {
					$item->register( [ $this, 'dispatch' ] );
					$this->real_callbacks[ $item->tag ] = $item->callback;
					if ( $item->heading_action ) {
						$this->heading_actions[ $item->tag ] = $item->heading_action;
					}
				}
			}
		}

		/**
		 * Detect shortcodes and do something before headers are sent.
		 *
		 * @return void
		 * @throws MCPL_Callback_Exception Thrown if callback is invalid.
		 */
		public function heading_actions_handler(): void {
			if ( $this->heading_actions && is_singular() ) {
				$this->find_shortcode( get_post_field( 'post_content', null, 'raw' ) );
				foreach ( array_unique( $this->found_tags ) as $tag_info ) {
					[ $tag, $atts, $enclosed ] = $tag_info;
					$callback = MCPL_Main::get_instance()->parse_callback( $this->heading_actions[ $tag ] );
					if ( is_callable( $callback ) ) {
						$callback( $atts, $enclosed, $tag );
					}
				}
			}
		}

		/**
		 * Shortcode callback.
		 *
		 * It invokes real callbacks by collected tags.
		 *
		 * @throws MCPL_Callback_Exception Thrown if callback is invalid.
		 */
		public function dispatch( array|string $atts, string $enclosed, string $tag ): string {
			$callback = MCPL_Main::get_instance()->parse_callback( $this->real_callbacks[ $tag ] ?? '__return_empty_string' );

			if ( is_callable( $callback ) ) {
				return $callback( $atts, $enclosed, $tag );
			}

			return '';
		}

		/**
		 * Find and collect shortcode tags in the content.
		 *
		 * @param string $content
		 *
		 * @return void
		 */
		protected function find_shortcode( string $content ): void {
			if ( ! str_contains( $content, '[' ) ) {
				return;
			}

			if ( ! $this->regex ) {
				$this->regex = '/' . get_shortcode_regex( array_keys( $this->heading_actions ) ) . '/';
			}

			/**
			 * @var array $matches idx 2: shortcode name. (tag)
			 *                     idx 3: shortcode atts.
			 *                     idx 5: enclosed text.
			 *
			 * @see get_shortcode_regex()
			 */
			if ( preg_match_all( $this->regex, $content, $matches, PREG_SET_ORDER ) ) {
				foreach ( $matches as $shortcode ) {
					if ( isset( $this->heading_actions[ $shortcode[2] ] ) ) {
						$this->found_tags[] = [ $shortcode[2], shortcode_parse_atts( $shortcode[3] ), $shortcode[5] ];
					}
					if ( ! empty( $shortcode[5] ) ) {
						$this->find_shortcode( $shortcode[5] );
					}
				}
			}
		}
	}
}
