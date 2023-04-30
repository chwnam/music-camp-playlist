<?php
/**
 * MCPL: Main class
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Main' ) ) {
	/**
	 * Class MCPL_Main
	 *
	 * @property-read MCPL_Admin       $admin
	 * @property-read MCPL_CLI         $cli
	 * @property-read MCPL_Fetcher     $fetcher
	 * @property-read MCPL_Registers   $registers
	 * @property-read MCPL_REST_Routes $REST_routes
	 * @property-read MCPL_Runner      $runner
	 * @property-read MCPL_Store       $store
	 */
	class MCPL_Main extends MCPL_Main_Base {
		/**
		 * Return modules that are initialized before 'init' action.
		 *
		 * @return array
		 * @used-by MCPL_Main_Base::initialize()
		 */
		protected function get_early_modules(): array {
			return [
				'admin'       => MCPL_Admin::class,
				'cli'         => MCPL_CLI::class,
				'fetcher'     => fn() => $this->new_instance( MCPL_Fetcher::class ),
				'registers'   => MCPL_Registers::class,
				'rest_routes' => MCPL_REST_Routes::class,
				'runner'      => MCPL_Runner::class,
				'store'       => fn() => $this->new_instance( MCPL_Store::class ),
			];
		}

		/**
		 * Return modules that should be initialized after 'init' action.
		 *
		 * Some features can be used properly after they are initialized,
		 *  and they are mostly done in the init callbacks.
		 *
		 * @return array
		 * @used-by MCPL_Main_Base::assign_init_modules()
		 */
		protected function get_late_modules(): array {
			return [];
		}

		/**
		 * Return module's constructor.
		 *
		 * @return array
		 */
		protected function get_constructors(): array {
			return [
				MCPL_Fetcher::class => function () {
					return [
						'RAMFM300', // prog_code.
					];
				},
			];
		}

		/**
		 * Do extra initialization.
		 *
		 * @return void
		 */
		protected function extra_initialize(): void {
			// phpcs:disable Squiz.PHP.CommentedOutCode, Squiz.Commenting.InlineComment.InvalidEndChar

			// Do some plugin-specific initialization tasks.
			// $plugin = plugin_basename( $this->get_main_file() );
			// $this->add_filter( "plugin_action_links_$plugin", 'add_plugin_action_links' );

			// phpcs:enable Squiz.PHP.CommentedOutCode, Squiz.Commenting.InlineComment.InvalidEndChar
		}

		/**
		 * Predefined action links callback method.
		 *
		 * @param array $actions List of current plugin action links.
		 *
		 * @return array
		 */
		public function add_plugin_action_links( array $actions ): array {
			/* @noinspection HtmlUnknownTarget */
			return array_merge(
				[
					'settings' => sprintf(
					/* translators: %1$s: link to settings , %2$s: aria-label  , %3$s: text */
						'<a href="%1$s" id="mcpl-settings" aria-label="%2$s">%3$s</a>',
						admin_url( 'options-general.php?page=mcpl' ), // NOTE: You need to implement the page.
						esc_attr__( 'MCPL settings', 'mcpl' ),
						esc_html__( 'Settings', 'mcpl' )
					),
				],
				$actions
			);
		}
	}
}
