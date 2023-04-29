<?php
/**
 * Naran Boilerplate Core
 *
 * interfaces/interface-mcpl-front-single-module.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! interface_exists( 'MCPL_Front_Single_Module' ) ) {
	interface MCPL_Front_Single_Module extends MCPL_Front_Module {
		public function pre_get_posts( WP_Query $query );
	}
}
