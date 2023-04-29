<?php
/**
 * Naran Boilerplate Core
 *
 * regs/class-mcpl-reg-capability.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Reg_Capability' ) ) {
	class MCPL_Reg_Capability implements MCPL_Reg {
		/**
		 * Constructor method
		 *
		 * @param string $role
		 * @param array  $capabilities
		 */
		public function __construct(
			public string $role,
			public array $capabilities
		) {
		}

		public function register( $dispatch = null ): void {
			$role = get_role( $this->role );

			if ( $role ) {
				foreach ( $this->capabilities as $capability ) {
					$role->add_cap( $capability );
				}
			}
		}

		public function unregister(): void {
			$role = get_role( $this->role );

			if ( $role ) {
				foreach ( $this->capabilities as $capability ) {
					$role->remove_cap( $capability );
				}
			}
		}
	}
}
