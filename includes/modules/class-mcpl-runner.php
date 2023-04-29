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

			$this->today_fetch();
			$this->incremental_fetch();

			$logger->info( "'mcpl_playlist' schedule finished." );
		}

		public function today_fetch(): void {
			$fetcher = mcpl()->fetcher;
			$store   = mcpl()->store;
			$last    = $store->get_last_date();

			$today = wp_date( 'Y-m-d', wp_timezone() );
			if ( $last === $today ) {
				return;
			}

			if ( empty( $last ) ) {
				$last_date = date_create_immutable( 'yesterday', wp_timezone() );
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

		public function incremental_fetch(): void {
			$fetcher   = mcpl()->fetcher;
			$store     = mcpl()->store;
			$page      = $store->get_last_page();
			$count     = 2;
			$last_date = "2006-01-01";

			if ( $store->is_last_page_reached() ) {
				return;
			}

			for ( $i = 1; $i <= $count; ++ $i ) {
				sleep( 2 );
				$items = $fetcher->fetch_list( $page + $i );

				while ( $items ) {
					$item = array_pop( $targets );
					$id   = $item['id'];
					$date = $item['date'];

					sleep( 2 );
					$playlist = $fetcher->fetch_item( $id );
					$store->save_playlist( $date, $playlist );

					if ( $date === $last_date ) {
						$store->set_last_page_reached( true );
					}
				}
			}

			$store->set_last_page( $page + $count );
		}
	}
}
