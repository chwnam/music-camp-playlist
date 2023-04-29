<?php
/**
 * Naran Boilerplate Core
 *
 * interfaces/interface-mcpl-front-archive-module.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! interface_exists( 'MCPL_Front_Archive_Module' ) ) {
	interface MCPL_Front_Archive_Module extends MCPL_Front_Module {
		public function pre_get_posts( WP_Query $query );

		public function get_posts_per_page(): int;
	}
}
