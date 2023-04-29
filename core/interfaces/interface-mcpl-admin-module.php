<?php
/**
 * Naran Boilerplate Core
 *
 * interfaces/interface-mcpl-admin-module.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! interface_exists( 'MCPL_Admin_Module' ) ) {
	interface MCPL_Admin_Module extends MCPL_Module {
	}
}
