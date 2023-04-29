<?php
/**
 * MCPL: uninstall script.
 */

if ( ! ( defined( 'WP_UNINSTALL_PLUGIN' ) && WP_UNINSTALL_PLUGIN ) ) {
	exit;
}

require_once __DIR__ . '/index.php';
require_once __DIR__ . '/core/uninstall-functions.php';

$mcpl_uninstall = mcpl()->registers->uninstall;
if ( $mcpl_uninstall ) {
	$mcpl_uninstall->register();
}

// You may use these functions to purge data.
// mcpl_cleanup_option();
// mcpl_cleanup_meta();
// mcpl_cleanup_terms();
// mcpl_cleanup_posts();
