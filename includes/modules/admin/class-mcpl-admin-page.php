<?php
/**
 * MCPL: Admin page module.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Admin_Page' ) ) {
	class MCPL_Admin_Page implements MCPL_Admin_Module {
		use MCPL_Hook_Impl;
		use MCPL_Template_Impl;

		public function __construct() {
		}
	}
}
