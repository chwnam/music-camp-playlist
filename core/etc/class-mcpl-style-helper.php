<?php
/**
 * Naran Boilerplate Core
 *
 * etc/class-mcpl-style-helper.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Style_Helper' ) ) {
	class MCPL_Style_Helper {
		/**
		 * Parent module object
		 *
		 * @var MCPL_Template_Impl|MCPL_Module
		 */
		private $parent;

		/**
		 * Script handle
		 *
		 * @var string
		 */
		private string $handle;

		/**
		 * Constructor method
		 *
		 * @param MCPL_Template_Impl|MCPL_Module $parent Parent module object.
		 * @param string                         $handle Script handle.
		 */
		public function __construct( $parent, string $handle ) {
			$this->parent = $parent;
			$this->handle = $handle;
		}

		/**
		 * Return another script helper.
		 *
		 * @param string $handle Handle string.
		 *
		 * @return MCPL_Script_Helper
		 */
		public function script( string $handle ): MCPL_Script_Helper {
			return new MCPL_Script_Helper( $this->parent, $handle );
		}

		/**
		 * Return another style helper.
		 *
		 * @param string $handle Handle string.
		 *
		 * @return MCPL_Style_Helper
		 */
		public function style( string $handle ): MCPL_Style_Helper {
			return new MCPL_Style_Helper( $this->parent, $handle );
		}

		/**
		 * Enqueue the style.
		 *
		 * @return self
		 */
		public function enqueue(): self {
			wp_enqueue_style( $this->handle );
			return $this;
		}

		/**
		 * Finish call chain
		 *
		 * @return MCPL_Module|MCPL_Template_Impl
		 */
		public function then() {
			return $this->parent;
		}
	}
}
