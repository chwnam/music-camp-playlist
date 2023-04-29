#!/usr/bin/env php
<?php
if ( 'cli' !== PHP_SAPI ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

define( 'MCPL_CLI_ROOT', __DIR__ );
define( 'MCPL_ROOT', dirname( __DIR__ ) );
define( 'THE_GULS', 'cpbn' );
define( 'THE_SLUG', strrev( THE_GULS ) );

if ( ! defined( 'MCPL_CLI_TEST' ) ) {
	$app = new MCPL_CLI_App();
	$app->run();
}
