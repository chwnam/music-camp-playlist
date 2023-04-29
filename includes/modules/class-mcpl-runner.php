<?php
/**
 * MCPL: Runnner module
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Runner' ) ) {
	class MCPL_Runner implements MCPL_Module {
		use MCPL_Hook_Impl;

		public function __construct() {
			/** @uses mcpl_playlist() */
			$this->add_action( 'mcpl_playlist' );
		}

		/**
		 * 라디오 플레이리스트 수집 스케쥴을 시작한다.
		 *
		 * @return void
		 */
		public function mcpl_playlist(): void {
			$logger = mcpl_get_logger();
			$logger->info( "Starting 'mcpl_playlist' schedule." );

			$this->recent_fetch();

			$logger->info( "'mcpl_playlist' schedule finished." );
		}

		public function recent_fetch( int $days = 2, bool $force = false ): void {
			$logger  = mcpl_get_logger();
			$fetcher = mcpl()->fetcher;
			$store   = mcpl()->store;
			$last    = $store->get_last_date();

			$today = wp_date( 'Y-m-d', null, wp_timezone() );
			if ( ! $force && $last === $today ) {
				$logger->info( "today_fetch() stopped because it is already fetched." );
				return;
			}

			if ( empty( $last ) || $force ) {
				$last_date = date_create_immutable( "$days days ago", wp_timezone() );
			} else {
				$last_date = date_create_immutable( $last, wp_timezone() );
			}

			sleep( 2 );
			$list    = $fetcher->fetch_list();
			$targets = [];

			foreach ( $list as $item ) {
				$item_date = date_create_immutable( $item['date'], wp_timezone() );
				if ( $item_date > $last_date ) {
					$targets[] = $item;
				} else {
					break;
				}
			}

			$logger->info( count( $targets ) . " item(s) targeted." );

			if ( $targets ) {
				$store->set_last_date( $targets[0]['date'] );
				while ( $targets ) {
					$item = array_pop( $targets );
					sleep( 2 );
					$playlist = $fetcher->fetch_item( $item['id'] );
					$store->save_playlist( $item['date'], $playlist );
				}
			}
		}

		public function fetch_page( int $page ): void {
			$logger  = mcpl_get_logger();
			$fetcher = mcpl()->fetcher;
			$store   = mcpl()->store;

			sleep( 2 );
			$logger->info( "Fetching page $page ..." );
			$items = $fetcher->fetch_list( $page );

			if ( ! $items ) {
				$logger->info( "Fetching page $page returned no items!" );
				return;
			}

			while ( $items ) {
				$item = array_pop( $items );
				$id   = $item['id'];
				$date = $item['date'];

				sleep( 2 );
				$logger->info( "Fetching $date ... " );
				$playlist = $fetcher->fetch_item( $id );
				$store->save_playlist( $date, $playlist );
			}

			$logger->info( "Fetching page $page is done." );
		}
	}
}
