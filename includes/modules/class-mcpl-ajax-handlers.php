<?php
/**
 * MCPL: AJAX handlers
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_AJAX_Handlers' ) ) {
	class MCPL_AJAX_Handlers implements MCPL_Module {
		public function referch_playlist(): void {
			$nonce = wp_unslash( $_REQUEST['nonce'] ?? '' );
			$date  = wp_unslash( $_REQUEST['date'] ?? '' );

			if ( ! wp_verify_nonce( $nonce, 'refetch-nonce-' . $date ) ) {
				wp_send_json_error( new WP_Error( 'error', 'NONCE verification failed.' ) );
			}

			mcpl()->runner->refetch( $date );

			wp_send_json_success();
		}
	}
}
