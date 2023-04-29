<?php
/**
 * MCPL: Admin post module.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Admin_Post' ) ) {
	class MCPL_Admin_Post implements MCPL_Admin_Module {
		use MCPL_Hook_Impl;
		use MCPL_Template_Impl;

		public function __construct() {
		}
	}
}
