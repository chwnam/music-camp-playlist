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
		 * Fetch
		 *
		 * ## OPTIONS
		 *
		 * <page>
		 * : page number.
		 *
		 * @param array $args
		 *
		 * @return void
		 * @throws WP_CLI\ExitException
		 */
		public function fetch( array $args ): void {
			$page = intval( $args[0] );

			if ( $page < 1 ) {
				WP_CLI::error( "Page should be a positive integer." );
			}

			WP_CLI::line( "Fetching page $page. Please wait a moment." );

			mcpl()->runner->fetch_page( $page );

			WP_CLI::success( "Done!" );
		}

		/**
		 * Fill all seq_ids.
		 *
		 * @return void
		 */
		public function fill_seqs(): void {
			$fetcher = mcpl()->fetcher;
			$store   = mcpl()->store;

			$page = 1;

			while ( true ) {
				sleep( 2 );
				WP_CLI::line( "Fetching page $page." );
				$list = $fetcher->fetch_list( $page );

				foreach ( $list as $item ) {
					$store->add_seq_id( $item['id'], 'RAMFM300', $item['date'] );
					if ( '2006-01-01' === $item['id'] ) {
						break 2;
					}
				}

				++ $page;
			}

			WP_CLI::success( "Done!" );
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
			$wpdb->query( "TRUNCATE {$wpdb->prefix}mcpl_artists" );

			mcpl()->store->set_last_page( 0 );

			WP_CLI::success( 'All MCPL tables truncated!' );
		}
	}
}
