<?php
/**
 * MCPL: Rest reoute register
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Register_REST_Route' ) ) {
	class MCPL_Register_REST_Route extends MCPL_Register_Base_REST_Route {
		/**
		 * Define your custom API endpoint.
		 *
		 * @return Generator
		 *
		 * @link   https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/
		 * @sample yield new MCPL_Reg_REST_Route(
		 *           'mcpl/v1',
		 *           'author/(?P<id>\d+)',
		 *           [
		 *             'methods'  => 'GET',
		 *             'callback' => 'module_v1@author'
		 *             'args'     => [
		 *               'id' => [
		 *                 'sanitize_callback' => 'module_v1@sanitize_id',
		 *                 'validate_callback' => 'module_v1@validate_id',
		 *                 'required'          => true,
		 *                 'default'           => '',
		 *               ],
		 *             ],
		 *           ]
		 *         );
		 */
		public function get_items(): Generator {
			yield from MCPL_REST_Routes::get_regs();
		}
	}
}
