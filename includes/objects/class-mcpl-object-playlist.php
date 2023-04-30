<?php
/**
 * MCPL: Artist object
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Object_Playlist' ) ) {
	class MCPL_Object_Playlist implements MCPL_Object {
		use MCPL_Object_Query_Trait;

		public int $id = 0;

		public string $date = '';

		public int $track_id = 0;

		public string $title = '';

		public int $artist_id = 0;

		public string $artist_name = '';
	}
}
