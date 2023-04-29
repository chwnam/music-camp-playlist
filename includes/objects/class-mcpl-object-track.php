<?php
/**
 * MCPL: Track object
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Object_Track' ) ) {
	class MCPL_Object_Track implements MCPL_Object {
		public int $id;

		public int $artist_id;

		public string $title;

		public static function from( array|stdClass $obj ): static {
			$instance = new static();

			if ( is_array( $obj ) ) {
				$instance->id        = absint( $obj['id'] ?? '0' );
				$instance->artist_id = absint( $obj['artist_id'] ?? '0' );
				$instance->title     = $obj['title'] ?? '';
			} elseif ( is_object( $obj ) ) {
				$instance->id        = absint( $obj->id ?? '0' );
				$instance->artist_id = absint( $obj->artist_id ?? '0' );
				$instance->title     = $obj->title ?? '';
			}

			return $instance;
		}
	}
}
