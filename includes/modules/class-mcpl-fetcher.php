<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Fetcher' ) ) {
	class MCPL_Fetcher implements MCPL_Module {
		const URL_BASE = 'https://miniweb.imbc.com/Music';

		public function __construct( private string $prog_code ) {
		}

		/**
		 * @param int $page
		 *
		 * @return array{array{id: number, date: string}}
		 */
		public function fetch_list( int $page = 1 ): array {
			$logger = mcpl_get_logger();

			$url = add_query_arg(
				[
					'progCode' => $this->prog_code,
					'page'     => max( 1, $page ),
				],
				static::URL_BASE
			);

			$logger->info( "Fetching URL $url ... " );
			$body = static::fetch_url( $url );

			preg_match_all( ':<td>(\d{4}-\d{2}-\d{2})</td>:', $body, $date_matches );
			preg_match_all( ":href='/Music/View\?seqID=(\d+)&amp;progCode=$this->prog_code&amp;page=1':", $body, $id_matches );

			$items = [];

			if ( isset( $date_matches[1], $id_matches[1] ) ) {
				for ( $i = 0; $i < count( $date_matches[1] ); ++ $i ) {
					$items[] = [
						'id'   => (int) $id_matches[1][ $i ],
						'date' => $date_matches[1][ $i ],
					];
				}
			}

			$logger->info( "Fetching list finished. " . ( count( $items ) ) . " item(s) collected." );

			return $items;
		}

		/**
		 * @param int|string $id 게시물 ID.
		 *
		 * @return array{array{artist: string, title: string}}
		 */
		public function fetch_item( int|string $id ): array {
			$logger = mcpl_get_logger();

			$url = add_query_arg(
				[
					'seqID'    => $id,
					'progCode' => $this->prog_code,
					'page'     => '1',
				],
				static::URL_BASE . "/View"
			);

			$logger->info( "Fetching URL $url ... " );
			$body = static::fetch_url( $url );

			preg_match_all( ':<td><p class="title">(.+?)</p></td>:', $body, $title_match );
			preg_match_all( ':<td><p class="singer">(.+?)</p></td>:', $body, $artist_match );

			$items = [];

			if ( isset( $title_match[1], $artist_match[1] ) ) {
				$excludeed_titles = [
					"Vienna Symphonic Orchestra Project" => "Satisfaction",
					"Acoustic Alchemy"                   => "Ballad For Kay",
				];

				for ( $i = 0; $i < count( $title_match[1] ); ++ $i ) {
					$artist = html_entity_decode( $artist_match[1][ $i ], ENT_QUOTES );
					$title  = html_entity_decode( $title_match[1][ $i ], ENT_QUOTES );

					if ( isset( $excludeed_titles[ $artist ] ) && str_starts_with( $title, $excludeed_titles[ $artist ] ) ) {
						continue;
					}

					$items[] = [
						'artist' => $artist,
						'title'  => $title,
					];
				}
			}

			$logger->info( "Fetching item finished. " . ( count( $items ) ) . " item(s) collected." );

			return $items;
		}

		public static function get_default_headers(): array {
			return [
				'Accept'     => 'text/html',
				'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/112.0',
			];
		}

		protected static function fetch_url( string $url, array $args = [] ): string {
			if ( empty( $args ) ) {
				$args = [
					'headers' => static::get_default_headers(),
				];
			}

			$r = wp_remote_get( $url, $args );

			if ( is_wp_error( $r ) ) {
				wp_die( sprintf( 'Error! %s: %s', $r->get_error_code(), $r->get_error_message() ) );
			}

			$status = wp_remote_retrieve_response_code( $r );
			$body   = wp_remote_retrieve_body( $r );

			if ( 200 !== $status ) {
				wp_die( "Error, $status" );
			}

			return $body;
		}
	}
}
