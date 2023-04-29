<?php
/**
 * Naran Boilerplate Core
 *
 * exceptions/class-mcpl-callback-exception.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Callback_Exception' ) ) {
	class MCPL_Callback_Exception extends Exception {
	}
}
