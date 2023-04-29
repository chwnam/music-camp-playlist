<?php

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Registry;

/**
 * MCPL
 *
 * functions.php
 */

// PHP_SAPI check make you run unit tests safely.
if ( ! defined( 'ABSPATH' ) && 'cli' !== PHP_SAPI ) {
	exit;
}

if ( ! function_exists( 'mcpl' ) ) {
	/**
	 * MCPL_Main alias.
	 */
	function mcpl(): MCPL_Main {
		return MCPL_Main::get_instance();
	}
}


if ( ! function_exists( 'mcpl_parse_module' ) ) {
	/**
	 * Retrieve submodule by given string notation.
	 */
	function mcpl_parse_module( string $module_notation ): object|false {
		return mcpl()->get_module_by_notation( $module_notation );
	}
}


if ( ! function_exists( 'mcpl_parse_callback' ) ) {
	/**
	 * Return submodule's callback method by given string notation.
	 *
	 * @throws MCPL_Callback_Exception Thrown if callback is invalid.
	 *
	 * @example foo.bar@baz ---> array( mcpl()->foo->bar, 'baz' )
	 */
	function mcpl_parse_callback( callable|array|string $maybe_callback ): callable|array|string {
		return mcpl()->parse_callback( $maybe_callback );
	}
}


if ( ! function_exists( 'mcpl_option' ) ) {
	/**
	 * Alias function for option.
	 */
	function mcpl_option(): ?MCPL_Register_Option {
		return mcpl()->registers->option;
	}
}


if ( ! function_exists( 'mcpl_comment_meta' ) ) {
	/**
	 * Alias function for comment meta.
	 */
	function mcpl_comment_meta(): ?MCPL_Register_Comment_Meta {
		return mcpl()->registers->comment_meta;
	}
}


if ( ! function_exists( 'mcpl_post_meta' ) ) {
	/**
	 * Alias function for post meta.
	 */
	function mcpl_post_meta(): ?MCPL_Register_Post_Meta {
		return mcpl()->registers->post_meta;
	}
}


if ( ! function_exists( 'mcpl_term_meta' ) ) {
	/**
	 * Alias function for term meta.
	 */
	function mcpl_term_meta(): ?MCPL_Register_Term_Meta {
		return mcpl()->registers->term_meta;
	}
}


if ( ! function_exists( 'mcpl_user_meta' ) ) {
	/**
	 * Alias function for user meta.
	 */
	function mcpl_user_meta(): ?MCPL_Register_User_Meta {
		return mcpl()->registers->user_meta;
	}
}


if ( ! function_exists( 'mcpl_get_front_module' ) ) {
	/**
	 * Get front module.
	 *
	 * The module is chosen in MCPL_Register_Theme_Support::map_front_modules().
	 *
	 * @see MCPL_Register_Theme_Support::map_front_modules()
	 */
	function mcpl_get_front_module(): MCPL_Front_Module {
		$hierarchy    = MCPL_Theme_Hierarchy::get_instance();
		$front_module = $hierarchy->get_front_module();

		if ( ! $front_module ) {
			$front_module = $hierarchy->get_fallback();
		}

		if ( ! $front_module instanceof MCPL_Front_Module ) {
			throw new RuntimeException( __( '$instance should be a front module instance.', 'mcpl' ) );
		}

		return $front_module;
	}
}


if ( ! function_exists( 'mcpl_doing_submit' ) ) {
	/**
	 * Chekc if request is from 'admin-post.php'
	 *
	 * @return bool
	 */
	function mcpl_doing_submit(): bool {
		return apply_filters( 'mcpl_doing_submit', is_admin() && str_ends_with( $_SERVER['SCRIPT_NAME'] ?? '', '/wp-admin/admin-post.php' ) );
	}
}


if ( ! function_exists( 'mcpl_create_upload_directory' ) ) {
	function mcpl_get_upload_private_directory( string $subdir = '' ): string {
		$dir        = wp_get_upload_dir();
		$subdir     = trim( $subdir, "\\/" );
		$upload_dir = untrailingslashit( $dir['basedir'] ) . "/mcpl";

		if ( ! file_exists( $upload_dir ) ) {
			mkdir( $upload_dir );
			file_put_contents( "$upload_dir/.htaccess", 'Require all denied' );
		}

		if ( $subdir ) {
			$upload_dir = "$upload_dir/$subdir";
			if ( file_exists( $upload_dir ) ) {
				wp_mkdir_p( $upload_dir );
			}
		}

		return $upload_dir;
	}
}


if ( ! function_exists( 'mcpl_get_log_directory' ) ) {
	function mcpl_get_log_directory(): string {
		return mcpl_get_upload_private_directory( 'log' );
	}
}


if ( ! function_exists( 'mcpl_get_logger' ) ) {
	function mcpl_get_logger(): Logger {
		if ( Registry::hasLogger( 'mcpl' ) ) {
			$logger = Registry::getInstance( 'mcpl' );
		} else {
			$dir = mcpl_get_log_directory();

			$formatter = new LineFormatter();
			$handler   = new RotatingFileHandler( "$dir/mcpl.log", 7 );
			$logger    = new Logger( 'mcpl' );

			$handler->setFormatter( $formatter );
			$logger->pushHandler( $handler );

			Registry::addLogger( $logger );
		}

		return $logger;
	}
}
