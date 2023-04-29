<?php
if ( ! interface_exists( 'MCPL_CLI_Command' ) ) {
	interface MCPL_CLI_Command {
		public static function add_command( Console_CommandLine $parser ): void;

		public static function get_command_name(): string;

		public function run( Console_CommandLine_Result $parsed ): void;
	}
}
