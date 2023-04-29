<?php
/**
 * MCPL: History object
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Object_History' ) ) {
	class MCPL_Object_History implements MCPL_Object {
		public int $id;

		public int $track_id;

		public string $date;

		public static function from( array|stdClass $obj ): static {
			$instance = new static();

			if ( is_array( $obj ) ) {
				$instance->id       = absint( $obj['id'] ?? '0' );
				$instance->track_id = absint( $obj['track_id'] ?? '0' );
				$instance->date     = $obj['date'] ?? '';
			} elseif ( is_object( $obj ) ) {
				$instance->id       = absint( $obj->id ?? '0' );
				$instance->track_id = absint( $obj->track_id ?? '0' );
				$instance->date     = $obj->date ?? '';
			}

			return $instance;
		}
	}
}
