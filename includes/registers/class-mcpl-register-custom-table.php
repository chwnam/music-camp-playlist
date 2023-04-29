<?php
/**
 * MCPL: Custom table register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_Custom_Table' ) ) {
	class MCPL_Register_Custom_Table extends MCPL_Register_Base_Custom_Table {
		use MCPL_Hook_Impl;

		const DB_VERSION = '20230428'; // Set DB version here.

		/**
		 * Constructor
		 *
		 * You may need to use activation callback to create table and insert initial data.
		 * You may need to use 'plugins_loaded' callback to check db version and to update table.
		 */
		public function __construct() {
			$this
				->add_action( 'mcpl_activation', 'initial_setup' )
				->add_action( 'plugins_loaded', 'update_table' )
			;
		}

		/**
		 * Return custom table items
		 *
		 * @return Generator
		 * @see    MCPL_Reg_Custom_Table::create_table()
		 */
		public function get_items(): Generator {
			global $wpdb;

			yield new MCPL_Reg_Custom_Table(
				"{$wpdb->prefix}mcpl_artists",
				[
					"id bigint(20) unsigned NOT NULL AUTO_INCREMENT",
					"name varchar(100) NOT NULL",
				],
				[
					"PRIMARY KEY  (id)",
					"UNIQUE KEY unique_name (name)",
					"FULLTEXT INDEX idx_name (name)",
				]
			);

			yield new MCPL_Reg_Custom_Table(
				"{$wpdb->prefix}mcpl_tracks",
				[
					"id bigint(20) unsigned NOT NULL AUTO_INCREMENT",
					"artist_id bigint(20) unsigned NOT NULL",
					"title varchar(255) NOT NULL",
				],
				[
					"PRIMARY KEY  (id)",
					"KEY idx_artist_id (artist_id)",
					"FULLTEXT INDEX idx_title (title)",
				]
			);

			yield new MCPL_Reg_Custom_Table(
				"{$wpdb->prefix}mcpl_history",
				[
					"id bigint(20) unsigned NOT NULL AUTO_INCREMENT",
					"track_id bigint(20) unsigned NOT NULL",
					"date date NOT NULL",
				],
				[
					"PRIMARY KEY  (id)",
					"KEY idx_track_id (track_id)",
					"KEY idx_date (date)",
				]
			);
		}

		/**
		 * Return initial table data.
		 *
		 * @return array Key: table name
		 *               Val: Array of key-value pair.
		 */
		public function get_initial_data(): array {
			global $wpdb;

			return [
//				"{$wpdb->prefix}my_table" => [
//					[
//						'title' => 'My Blog',
//						'url'   => 'https://my.blog.io/',
//					],
//					[
//						...
//					]
//				],
			];
		}
	}
}
