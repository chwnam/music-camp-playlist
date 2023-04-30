<?php
/**
 * MCPL: Playlist query
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Object_Playlist_Query' ) ) {
	class MCPL_Object_Playlist_Query implements MCPL_Object {
		use MCPL_Object_Query_Trait;

		/** @var MCPL_Object_Playlist[] $items */
		public array $items = [];

		public int $total = 0;

		public int $total_pages = 0;

		public int $per_page = 0;

		public int $page = 0;

		public float $time_spent = 0.0;
	}
}
