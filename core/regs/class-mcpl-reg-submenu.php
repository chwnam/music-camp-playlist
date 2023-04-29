<?php
/**
 * Naran Boilerplate Core
 *
 * regs/class-mcpl-reg-submenu.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Reg_Submenu' ) ) {
	class MCPL_Reg_Submenu implements MCPL_Reg {
		/**
		 * Constructor method
		 */
		public function __construct(
			public string $parent_slug,
			public string $page_title,
			public string $menu_title,
			public string $capability,
			public string $menu_slug,
			public Closure|array|string $callback,
			public ?int $position = null
		) {
		}

		/**
		 * @param callable|null $dispatch
		 *
		 * @return string
		 */
		public function register( $dispatch = null ): string {
			return add_submenu_page(
				$this->parent_slug,
				$this->page_title,
				$this->menu_title,
				$this->capability,
				$this->menu_slug,
				$dispatch,
				$this->position
			);
		}
	}
}
