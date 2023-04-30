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

			/** @uses mcpl_scrap_all() */
			$this->add_action( 'mcpl_scrap_all' );
		}

		/**
		 * 라디오 플레이리스트 수집 스케쥴을 시작한다.
		 *
		 * @return void
		 */
		public function mcpl_playlist(): void {
			$this->daily_fetch();
		}

		/**
		 * 지정된 주기마다 페이지를 모두 수집 처리.
		 */
		public function mcpl_scrap_all(): void {
			$store      = mcpl()->store;
			$last_page  = $store->get_last_page();
			$first_date = $store->get_first_date();

			if ( $first_date !== '2006-01-01' ) {
				$this->fetch_page( $last_page + 1 );
				$store->set_last_page( $last_page + 1 );
			}
		}

		/**
		 * 오늘의 플레이리스트 추출.
		 *
		 * @return void
		 */
		public function daily_fetch(): void {
			$fetcher = mcpl()->fetcher;
			$store   = mcpl()->store;

			$now  = date_create_immutable( 'now', wp_timezone() );
			$last = $store->get_last_date();
			$date = date_create_immutable( $last ?: "5 days ago", wp_timezone() );

			if ( $last === $now->format( 'Y-m-d' ) || 21 > ( (int) $now->format( 'G' ) ) ) {
				// 음악캠프가 끝나는 시각은 오후 8시이고, 선곡표를 올리는 시간의 여유는 1시간으로 두면 최소 오후 9시는 되어야
				// 그 날의 선곡표 업데이트를 기대할 수 있을 것이다.
				return;
			}

			sleep( 2 );
			$list = $fetcher->fetch_list();

			while ( $list ) {
				$item      = array_pop( $list );
				$item_date = date_create_immutable( $item['date'], wp_timezone() );
				if ( $item_date > $date ) {
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
