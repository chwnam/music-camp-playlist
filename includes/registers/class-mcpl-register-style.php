<?php
/**
 * MCPL: Style register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Style' ) ) {
	class MCPL_Register_Style extends MCPL_Register_Base_Style {
		/**
		 * Return Style regs.
		 *
		 * @return Generator
		 */
		public function get_items(): Generator {
			yield new MCPL_Reg_Style(
				'mcpl-calendar-style',
				plugins_url( 'assets/vendor/calendar/style.css', mcpl_main_file() ),
				[],
				'1.4'
			);

			yield new MCPL_Reg_Style(
				'mcpl-calendar-theme',
				plugins_url( 'assets/vendor/calendar/theme.css', mcpl_main_file() ),
				[],
				'1.4'
			);

			yield new MCPL_Reg_Style(
				'mcpl-calendar',
				$this->src_helper( 'playlist-calendar.css' ),
				[ 'mcpl-calendar-style', 'mcpl-calendar-theme' ],
			);
		}
	}
}
