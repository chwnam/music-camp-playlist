<?php
/**
 * MCPL: Store module
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Store' ) ) {
	/**
	 */
	class MCPL_Store implements MCPL_Module {
		public function has_artist( string $name ): int {
			global $wpdb;

			$query = $wpdb->prepare( "SELECT id FROM {$wpdb->prefix}mcpl_artists WHERE name=%s LIMIT 0, 1", $name );

			return (int) $wpdb->get_var( $query );
		}

		public function has_track( int $artist_id, string $title ): int {
			global $wpdb;

			$query = $wpdb->prepare(
				"SELECT id FROM {$wpdb->prefix}mcpl_tracks WHERE artist_id=%d AND title=%s LIMIT 0, 1",
				$artist_id,
				$title
			);

			return (int) $wpdb->get_var( $query );
		}

		public function has_history( int $tracK_id, string $date ): int {
			global $wpdb;

			$query = $wpdb->prepare(
				"SELECT id FROM {$wpdb->prefix}mcpl_history WHERE track_id=%d AND date=%s LIMIT 0, 1",
				$tracK_id,
				$date
			);

			return (int) $wpdb->get_var( $query );
		}

		public function add_artist( string $name ): int {
			global $wpdb;

			$artist_id = $this->has_artist( $name );

			if ( ! $artist_id ) {
				$wpdb->insert(
					"{$wpdb->prefix}mcpl_artists",
					[ 'name' => $name ]
				);

				$artist_id = $wpdb->insert_id;
			}

			return $artist_id;
		}

		public function add_track( int $artist_id, string $title ): int {
			global $wpdb;

			$track_id = $this->has_track( $artist_id, $title );

			if ( ! $track_id ) {
				$wpdb->insert(
					"{$wpdb->prefix}mcpl_tracks",
					[
						'artist_id' => $artist_id,
						'title'     => $title,
					],
					[
						'artist_id' => '%d',
						'title'     => '%s',
					]
				);

				$track_id = $wpdb->insert_id;
			}

			return $track_id;
		}

		public function add_history( int $track_id, string $date ): int {
			global $wpdb;

			$history_id = $this->has_history( $track_id, $date );

			if ( ! $history_id ) {
				$wpdb->insert(
					"{$wpdb->prefix}mcpl_history",
					[
						'track_id' => $track_id,
						'date'     => $date,
					],
					[
						'track_id' => '%d',
						'date'     => '%s',
					]
				);

				$history_id = $wpdb->insert_id;
			}

			return $history_id;
		}

		/**
		 * @param array $args
		 *
		 * @return MCPL_Object_Playlist_Query
		 */
		public function query( array $args = [] ): MCPL_Object_Playlist_Query {
			global $wpdb;

			$defaults = [
				'since' => '',
				'days'  => 1,
			];

			$args = wp_parse_args( $args, $defaults );

			if ( $args['since'] ) {
				$since = date_create_immutable( "{$args['since']} 00:00:00", wp_timezone() );
			} else {
				$since = date_create_immutable( $this->get_last_date(), wp_timezone() );
			}

			$days  = $args['days'] ?: 1;
			$until = $since->sub( new DateInterval( "P{$days}D" ) );

			$fields = [
				"h.id",
				"h.date",
				"t.id AS track_id",
				"t.title",
				"a.id AS artist_id",
				"a.name AS artist_name",
			];

			$f     = implode( ', ', $fields );
			$where = $wpdb->prepare(
				'WHERE h.date > %s AND h.date <= %s',
				$until->format( 'Y-m-d' ),
				$since->format( 'Y-m-d' ),
			);

//			if ( $args['search'] ) {
//				$like  = esc_sql( '%' . $wpdb->esc_like( $args['search'] ) . '%' );
//				$where .= $wpdb->prepare(
//					" AND ((a.name LIKE %s) OR (t.title LIKE %s))",
//					$like,
//					$like
//				);
//			}
//
//			if ( $args['artist_id'] ) {
//				$where .= $wpdb->prepare( " AND a.id=%d", $args['artist_id'] );
//			}
//
//			if ( $args['track_id'] ) {
//				$where .= $wpdb->prepare( " AND t.id=%d", $args['track_id'] );
//			}

			$query = "SELECT SQL_CALC_FOUND_ROWS $f FROM {$wpdb->prefix}mcpl_artists AS a" .
			         " INNER JOIN {$wpdb->prefix}mcpl_tracks AS t ON t.artist_id=a.id" .
			         " INNER JOIN {$wpdb->prefix}mcpl_history AS h ON h.track_id=t.id" .
			         " $where ORDER BY h.date DESC, h.id";

			$wpdb->timer_start();
			$rows       = $wpdb->get_results( $query );
			$time       = $wpdb->timer_stop();
			$found_rows = (int) $wpdb->get_var( "SELECT FOUND_ROWS()" );
			$records    = array_map( [ MCPL_Object_Playlist::class, 'from' ], $rows );

			$result             = new MCPL_Object_Playlist_Query();
			$result->items      = $records;
			$result->total      = $found_rows;
			$result->time_spent = $time;

			return $result;
		}

		/**
		 * @param string                                      $date
		 * @param array{array{artist: string, title: string}} $playlist
		 *
		 * @return void
		 */
		public function save_playlist( string $date, array $playlist ): void {
			$logger = mcpl_get_logger();
			$logger->debug( 'Saving playlist for ' . $date );

			foreach ( $playlist as $item ) {
				$logger->debug( sprintf( "Ttem %s - %s", $item['artist'], $item['title'] ) );

				$artist_id = $this->add_artist( $item['artist'] );
				$track_id  = $this->add_track( $artist_id, $item['title'] );
				$this->add_history( $track_id, $date );
			}
		}

		public function get_last_date(): string {
			global $wpdb;

			return $wpdb->get_var( "SELECT MAX(date) FROM {$wpdb->prefix}mcpl_history" ) ?: '';
		}

		public function get_first_date(): string {
			global $wpdb;

			return $wpdb->get_var( "SELECT MIN(date) FROM {$wpdb->prefix}mcpl_history" ) ?: '';
		}

		public function get_last_page(): int {
			return (int) ( get_site_transient( 'mcpl_last_page' ) ?: 0 );
		}

		public function set_last_page( int $page ): void {
			set_site_transient( 'mcpl_last_page', $page );
		}
	}
}
