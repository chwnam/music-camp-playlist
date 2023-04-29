<?php
/**
 * MCPL: Artist object
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Object_Artist' ) ) {
	class MCPL_Object_Artist implements MCPL_Object {
		public int $id = 0;

		public string $name = '';

		public static function from( array|stdClass $obj ): static {
			$instance = new static();

			if ( is_array( $obj ) ) {
				$instance->id   = absint( $obj['id'] ?? '0' );
				$instance->name = $obj['name'] ?? '';
			} elseif ( is_object( $obj ) ) {
				$instance->id   = absint( $obj->id ?? '0' );
				$instance->name = $obj->name ?? '';
			}

			return $instance;
		}
	}
}
