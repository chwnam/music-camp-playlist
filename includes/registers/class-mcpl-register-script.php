<?php
/**
 * MCPL: Script register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Script' ) ) {
	class MCPL_Register_Script extends MCPL_Register_Base_Script {
		public function get_items(): Generator {
			yield new MCPL_Reg_Script(
				'mpcl-moment',
				plugins_url( 'assets/vendor/moment/moment.min.js', mcpl_main_file() ),
				[],
				'2.29.4',
				true
			);

			yield new MCPL_Reg_Script(
				'mpcl-calendar',
				plugins_url( 'assets/vendor/calendar/calendar.min.js', mcpl_main_file() ),
				[ 'jquery' ],
				'1.4',
				true
			);

			yield new MCPL_Reg_Script(
				'mcpl-playlist-calendar',
				$this->src_helper( 'playlist-calendar.js', false ),
				[ 'mpcl-moment', 'mpcl-calendar' ],
				null,
				true
			);
		}
	}
}
