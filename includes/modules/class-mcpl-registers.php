<?php
/**
 * MCPL: Registers module
 *
 * Manage all registers
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Registers' ) ) {
	/**
	 * You can remove unused registers.
	 *
	 * @property-read MCPL_Register_Activation    $activation
	 * @property-read MCPL_Register_Ajax          $ajax
	 * @property-read MCPL_Register_Block         $block
	 * @property-read MCPL_Register_Capability    $cap
	 * @property-read MCPL_Register_Comment_Meta  $comment_meta
	 * @property-read MCPL_Register_Cron          $cron
	 * @property-read MCPL_Register_Cron_Schedule $cron_schedule
	 * @property-read MCPL_Register_Custom_Table  $custom_table
	 * @property-read MCPL_Register_Deactivation  $deactivation
	 * @property-read MCPL_Register_Menu          $menu
	 * @property-read MCPL_Register_Option        $option
	 * @property-read MCPL_Register_Post_Meta     $post_meta
	 * @property-read MCPL_Register_Post_Type     $post_type
	 * @property-read MCPL_Register_Rest_Route    $rest_route
	 * @property-read MCPL_Register_Rewrite_Rule  $rewrite_rule
	 * @property-read MCPL_Register_Role          $role
	 * @property-read MCPL_Register_Script        $script
	 * @property-read MCPL_Register_Shortcode     $shortcode
	 * @property-read MCPL_Register_Sidebar       $sidebar
	 * @property-read MCPL_Register_Style         $style
	 * @property-read MCPL_Register_Submit        $submit
	 * @property-read MCPL_Register_Taxonomy      $taxonomy
	 * @property-read MCPL_Register_Theme_Support $theme_support
	 * @property-read MCPL_Register_Term_Meta     $term_meta
	 * @property-read MCPL_Register_Uninstall     $uninstall
	 * @property-read MCPL_Register_User_Meta     $user_meta
	 * @property-read MCPL_Register_Widget        $widget
	 * @property-read MCPL_Register_WP_CLI        $wp_cli
	 */
	class MCPL_Registers implements MCPL_Module {
		use MCPL_Submodule_Impl;

		/**
		 * Constructor method
		 */
		public function __construct() {
			/**
			 * You can remove unused registers.
			 */
			$this->assign_modules(
				[
//					'activation'    => MCPL_Register_Activation::class,
					'ajax'          => MCPL_Register_AJAX::class,
//					'block'         => MCPL_Register_Block::class,
//					'cap'           => function () { return new MCPL_Register_Capability(); },
//					'comment_meta'  => MCPL_Register_Comment_Meta::class,
					'cron'          => MCPL_Register_Cron::class,
					'cron_schedule' => MCPL_Register_Cron_Schedule::class,
					'custom_table'  => MCPL_Register_Custom_Table::class,
//					'deactivation'  => MCPL_Register_Deactivation::class,
//					'menu'          => MCPL_Register_Menu::class,
//					'option'        => MCPL_Register_Option::class,
//					'post_meta'     => MCPL_Register_Post_Meta::class,
//					'post_type'     => MCPL_Register_Post_Type::class,
					'rest_route'    => MCPL_Register_REST_Route::class,
//					'rewrite_rule'  => MCPL_Register_Rewrite_Rule::class,
//					'role'          => function () { return new MCPL_Register_Role(); },
//					'script'        => MCPL_Register_Script::class,
//					'shortcode'     => MCPL_Register_Shortcode::class,
//					'sidebar'       => MCPL_Register_Sidebar::class,
//					'style'         => MCPL_Register_Style::class,
//					'submit'        => MCPL_Register_Submit::class,
//					'taxonomy'      => MCPL_Register_Taxonomy::class,
//					'term_meta'     => MCPL_Register_Term_Meta::class,
					// 'theme_support' => MCPL_Register_Theme_Support::class, // Only for themes.
//					'uninstall'     => function () { return new MCPL_Register_Uninstall(); },
//					'user_meta'     => MCPL_Register_User_Meta::class,
//					'widget'        => MCPL_Register_Widget::class,
					'wp_cli'        => MCPL_Register_WP_CLI::class,
				]
			);
		}
	}
}
