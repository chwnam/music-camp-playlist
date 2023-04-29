<?php
/**
 * Naran Boilerplate Core
 *
 * regs/class-mcpl-reg-widget.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Reg_Widget' ) ) {
	class MCPL_Reg_Widget implements MCPL_Reg {
		/**
		 * Constructor method
		 *
		 * @param WP_Widget|string| $widget String is class name of Widget subclass.
		 */
		public function __construct(
			public WP_Widget|string $widget
		) {
		}

		public function register( $dispatch = null ): void {
			register_widget( $this->widget );
		}
	}
}
