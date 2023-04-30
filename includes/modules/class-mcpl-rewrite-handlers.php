<?php
/**
 * MCPL: Rewrite handlers
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Rewrite_Handlers' ) ) {
	class MCPL_Rewrite_Handlers implements MCPL_Module {
		use MCPL_Template_Impl;

		const MODULE = 'rewrite_handlers';

		public static function get_regs(): Generator {
			$module = static::MODULE;

			/**
			 * @uses MCPL_Rewrite_Handlers::playlist()
			 */
			yield new MCPL_Reg_Rewrite_Rule(
				'^music-camp/?$',
				'index.php?mcpl=playlist',
				'top',
				"$module@playlist",
				[ 'mcpl' ]
			);
		}

		public function playlist(): void {
			$store = mcpl()->store;

			$date = wp_unslash( $_GET['date'] ?? '' );
//			$days = absint( $_GET['days'] ?? '1' );

			$object = $store->query( [ 'since' => $date ] );
			$items  = [];

			foreach ( $object->items as $item ) {
				$items[ $item->date ][] = $item;
			}

			$this->render(
				'playlist',
				[
					'music_icon_url' => plugins_url( 'assets/img/icons8-youtube.svg', MCPL_MAIN_FILE ),
					'video_icon_url' => plugins_url( 'assets/img/icons8-youtube-music.svg', MCPL_MAIN_FILE ),
					'items'          => $items,
				]
			);
		}
	}
}