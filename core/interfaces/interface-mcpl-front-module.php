<?php
/**
 * Naran Boilerplate Core
 *
 * interfaces/interface-mcpl-front-module.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! interface_exists( 'MCPL_Front_Module' ) ) {
	interface MCPL_Front_Module extends MCPL_Module {
		public function display(): void;
	}
}
