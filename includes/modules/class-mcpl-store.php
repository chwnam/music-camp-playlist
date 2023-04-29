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
		 * @param string                                      $date
		 * @param array{array{artist: string, title: string}} $playlist
		 *
		 * @return void
		 */
		public function save_playlist( string $date, array $playlist ): void {
			foreach ( $playlist as $item ) {
				$artist_id = $this->add_artist( $item['artist'] );
				$track_id  = $this->add_track( $artist_id, $item['title'] );
				$this->add_history( $track_id, $date );
			}
		}

		public function get_last_date(): string {
			$last_date = get_transient( 'mcpl_last_date' );

			return $last_date ?: '';
		}

		public function set_last_date( string $date ): void {
			set_transient( 'mcpl_last_date', $date );
		}

		public function get_last_page(): int {
			$chapter = (int) get_transient( 'mcpl_last_page' );

			return max( 0, $chapter );
		}

		public function set_last_page( int $page ): void {
			set_transient( 'mcpl_last_page', $page );
		}

		public function is_last_page_reached(): bool {
			return (bool) get_transient( 'mcpl_last_page_reached' );
		}

		public function set_last_page_reached( bool $reached ): void {
			set_transient( 'mcpl_last_page_reached', $reached );
		}
	}
}
