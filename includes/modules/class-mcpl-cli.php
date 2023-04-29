<?php
/**
 * MCPL: CLI module
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_CLI' ) ) {
	/**
	 */
	class MCPL_CLI implements MCPL_Module {
		/**
		 * Run now.
		 *
		 * @subcommand
		 *
		 * @return void
		 */
		public function run(): void {
			WP_CLI::success( 'Okay!' );
		}

		/**
		 * Clear database.
		 *
		 * @subcommand
		 *
		 * @return void
		 */
		public function clear(): void {
			global $wpdb;

			WP_CLI::confirm( WP_CLI::colorize( '%RThis action cannot be undone! Are you sure?%N' ) );

			$wpdb->query( "TRUNCATE {$wpdb->prefix}mcpl_history" );
			$wpdb->query( "TRUNCATE {$wpdb->prefix}mcpl_tracks" );
			$wpdb->query( "TRUNCATE {$wpdb->prefix}mpcl_artists" );

			mcpl()->store->set_last_date( '' );
			mcpl()->store->set_last_page( 0 );
			mcpl()->store->set_last_page_reached( false );

			WP_CLI::success( 'All MCPL tables truncated!' );
		}
	}
}
